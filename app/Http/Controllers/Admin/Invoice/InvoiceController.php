<?php

namespace App\Http\Controllers\Admin\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Invoice\AddProductRequest;
use App\Http\Requests\Admin\Invoice\InvoiceRequest;
use App\Http\Requests\Admin\Invoice\ServiceRequest;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Http\Traits\HasProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Supplier;
use App\Rules\CustomUniqueTitle;
use App\Services\ImageService\ImageService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    use HasProduct;


    public function productIndex()
    {
        Gate::authorize('admin.invoice.product.index');
        $breadcrumbs = Breadcrumbs::render('admin.invoice.product.index')->getData()['breadcrumbs'];
        $invoices = Invoice::search()->whereHas('invoiceItem', function (Builder $query) {
            $query->where('type', 'product');
        })->where('type_of_business', 'buy')->paginate(20, ['*'], 'page')->withQueryString();
        return view('Admin.Invoice.Product.index', compact('invoices', 'breadcrumbs'));
    }

    public function invoiceProduct(Invoice $invoice)
    {
        $breadcrumbs = Breadcrumbs::render('admin.invoice.product.invoiceProduct', $invoice)->getData()['breadcrumbs'];
        return view('Admin.Invoice.Product.itemProductIndex', compact('invoice', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        Gate::authorize('admin.invoice.product.create');
        $categories = Category::where('status', 'active')->get();
        $brands = Brand::where("status", 'active')->get();
        $breadcrumbs = Breadcrumbs::render('admin.invoice.product.create')->getData()['breadcrumbs'];
        $products = Product::where('type', 'goods')->where('status', 'active')->get();
        $suppliers = Supplier::where('status', 'active')->get();
        return view('Admin.Invoice.Product.create', compact('suppliers', 'products', 'breadcrumbs', 'brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request)
    {
        Gate::authorize('admin.invoice.product.create');
        $inputs = $request->all();
        $user = Auth::user();
        $productItems = $this->separationOfArraysFromText($inputs);
        if (!$this->arrayCountValidation($productItems)) {
            return redirect()->route('admin.invoice.product.index')->withErrors(['error' => 'مقدار های داده شده باهم برابر نیست لطفا مجددا تلاش فرمایید']);
        }

        $products = collect();
        foreach ($productItems['product_id'] as $key => $product) {
            $product = [];
            foreach ($productItems as $keyValue => $input) {
                if (isset($input[$key])) {
                    $product[$keyValue] = $input[$key];
                }
            }

            $products->push($product);
        }
        $productsGruop = $products->groupBy('product_id');


        $updateCollectionProduct = collect();
        $productItem = collect();
        $finalAmount = 0;
        foreach ($productsGruop->all() as $groupp) {
            $amount = 0;
            foreach ($groupp as $item) {
                $amount += $item['amount'];
                $updateCollectionProduct->push(
                    [
                        'product_id' => $item['product_id'],
                        'description' => $item['description']??null,
                        'amount' => $amount,
                        'price' => $item['price'],
                        'type' => 'product'
                    ]
                );

            }
            $productItem->push($updateCollectionProduct->last());
        }

        foreach ($productItem->toArray() as $productPrice) {
            $finalAmount += $productPrice['amount'] * $productPrice['price'];
        }
        $invouce = Invoice::create([
            'operator_id' => $user->id,
            'type_of_business' => 'buy',
            'supplier_id' => $request->supplier_id,
            'final_amount' => $finalAmount,
            'description' => $inputs['invoiceDesc']
        ]);
        $invouce->invoiceItem()->createMany($productItem->all());
        foreach ($productItem as $itemTransaction) {
            $productTransaction = ProductTransaction::where('product_id', $itemTransaction['product_id'])->latest()->first();
            $itemTransaction['type'] = 'add';
            $itemTransaction['remain'] = $itemTransaction['amount'];
            $itemTransaction['user_id'] = $user->id;
            if ($productTransaction) {
                $itemTransaction['remain'] = $itemTransaction['amount'] + $productTransaction->remain;
            }
            $invouce->productTransaction()->create($itemTransaction);
        }
        return redirect()->route('admin.invoice.product.index')->with(['success' => 'فاکتور جدید شما ایجاد شد و محصولات شما به انبار اضافه گردید']);


    }

    public function addProduct(Request $request, ImageService $imageService)
    {

        $inputs = $request->all();
        parse_str($inputs['content'], $output);
        $output['file'] = $request->file('file');
        if ($output['related_goods']=='null')
        {
            $output['related_goods']=null;
        }
        $validation = Validator::make($output, [
            'title' => ['required', 'min:3', new CustomUniqueTitle],
            'product-price' => 'required|numeric:min:10000',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|in:active,inactive',
            'type' => 'required|in:goods,service',
            'related_goods'=>'nullable|exists:categories,id',
            'description' => 'nullable|min:3',
            'file' => [
                'required',
                'file',
                'mimes:jpg,png,jpeg',
                'max:' . env('FILE_SIZE')],
        ], attributes: [
            'type' => 'نوع محصول',
            'product-price' => 'قیمت',
            'related_goods'=>'خدمات مربوط'
        ]);
        if (!$validation->validate()) {
            return true;
        }
        $output['price'] = $output['product-price'];

        $user = Auth::user();
        $output['user_id'] = $user->id;
        $product = Product::create($output);
        $imageService->setRootFolder('ProductStore' . DIRECTORY_SEPARATOR . "image");
        $image = $imageService->saveImage($request->file('file'));

        if (!$image)
            return response()->json(['status' => false, 'message' => 'در ذخیره سازی عکس خطایی به وجود امد']);

        $product->image()->create([
            'path' => $image,
            'user_id' => $user->id
        ]);

        if ($product) {
            return response()->json(['status' => true, 'success' => 'محصول جدید شما اضافه  شد','data'=>Product::where('status','active')->get(),'product'=>$product]);
        } else {
            return response()->json(['status' => false, 'message' => 'افزودن محصول با خطا مواجه شد','data'=>[]]);
        }
    }

    public function editProduct(Invoice $invoice)
    {
        Gate::authorize('admin.invoice.product.edit');
        $categories = Category::where('status', 'active')->get();
        $brands = Brand::where("status", 'active')->get();
        $breadcrumbs = Breadcrumbs::render('admin.invoice.product.edit', $invoice)->getData()['breadcrumbs'];

        $products = Product::where('type', 'goods')->where('status', 'active')->get();
        $suppliers = Supplier::where('status', 'active')->get();
        return view('Admin.Invoice.Product.edit', compact('suppliers', 'products', 'invoice', 'breadcrumbs','brands','categories'));

    }

    public function updateProduct(InvoiceRequest $request, Invoice $invoice)
    {
        Gate::authorize('admin.invoice.product.edit');

        DB::beginTransaction();

        try {

            $inputs = $request->all();
            $user = Auth::user();
            $productItems = $this->separationOfArraysFromText($inputs);
            if (!$this->arrayCountValidation($productItems)) {
                return redirect()->route('admin.invoice.product.index')->withErrors(['error' => 'مقدار های داده شده باهم برابر نیست لطفا مجددا تلاش فرمایید']);
            }
            $products = collect();
            foreach ($productItems['product_id'] as $key => $product) {

                $product = [];
                foreach ($productItems as $keyValue => $input) {
                    if (isset($input[$key])) {
                        $product[$keyValue] = $input[$key];
                    }
                }


                $products->push($product);
            }
            $productsGruop = $products->groupBy('product_id');


            $updateCollectionProduct = collect();
            $productItem = collect();
            $finalAmount = 0;
            foreach ($productsGruop->all() as $groupp) {
                $amount = 0;
                foreach ($groupp as $item) {
                    $amount += $item['amount'];
                    $updateCollectionProduct->push(
                        [
                            'product_id' => $item['product_id'],
                            'description' => $item['description']??null,
                            'amount' => $amount,
                            'price' => $item['price'],
                            'type' => 'product',
                        ]
                    );

                }
                $productItem->push($updateCollectionProduct->last());
            }

            foreach ($productItem->toArray() as $productPrice) {
                $finalAmount += $productPrice['amount'] * $productPrice['price'];
            }
            $invoice->invoiceItem->each->delete();
            $invoice->update([
                'operator_id' => $user->id,
                'type_of_business' => 'buy',
                'supplier_id' => $request->supplier_id,
                'final_amount' => $finalAmount,
                'description' => $inputs['invoiceDesc']
            ]);

            foreach ($productItem as $itemTransaction) {
                $itemTransaction['type'] = 'add';
                $itemTransaction['remain'] = $itemTransaction['amount'];
                $itemTransaction['user_id'] = $user->id;
                $invoice->productTransaction()->create($itemTransaction);
            }

            $invoice->invoiceItem()->createMany($productItem->all());

            DB::commit();
            return redirect()->route('admin.invoice.product.index')->with(['success' => 'فاکتور  شما یرایش  شد و محصولات شما در انبار اضافه ویرایش گردید']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.invoice.product.index')->withErrors(['updateError' => 'ویرایش فاکتور شما با خطا مواجه شد لطفا مجددا تلاش فرمایید.']);

        }


    }

    public function serviceIndex()
    {
        Gate::authorize('admin.invoice.service.index');
        $breadcrumbs = Breadcrumbs::render('admin.invoice.service.index')->getData()['breadcrumbs'];

        $invoices = Invoice::search()->whereHas('invoiceItem', function (Builder $query) {
            $query->where('type', 'service');
        })->where('type_of_business', 'buy')->paginate(20, ['*'], 'page')->withQueryString();
        return view('Admin.Invoice.Service.index', compact('invoices', 'breadcrumbs'));
    }


    public function invoiceService(Invoice $invoice)
    {
        $breadcrumbs = Breadcrumbs::render('admin.invoice.service.invoiceService', $invoice)->getData()['breadcrumbs'];
        return view('Admin.Invoice.Service.itemProductindex', compact('invoice', 'breadcrumbs'));
    }


    public function serviceCreate()
    {
        Gate::authorize('admin.invoice.service.create');
        $categories = Category::where('status', 'active')->get();
        $brands = Brand::where("status", 'active')->get();
        $breadcrumbs = Breadcrumbs::render('admin.invoice.service.create')->getData()['breadcrumbs'];
        $products = Product::where('type', 'service')->where('status', 'active')->get();
        $suppliers = Supplier::where('status', 'active')->get();
        return view('Admin.Invoice.Service.create', compact('suppliers', 'products', 'breadcrumbs','categories','brands'));

    }

    public function serviceStore(ServiceRequest $request)
    {
        Gate::authorize('admin.invoice.service.create');
        $inputs = $request->all();
        $user = Auth::user();
        $productItems = $this->separationOfArraysFromText($inputs);
        if (!$this->arrayCountValidation($productItems)) {
            return redirect()->route('admin.invoice.service.index')->withErrors(['error' => 'مقدار های داده شده باهم برابر نیست لطفا مجددا تلاش فرمایید']);
        }

        $products = collect();
        foreach ($productItems['product_id'] as $key => $product) {
            $product = [];
            foreach ($productItems as $keyValue => $input) {
                if (isset($input[$key])) {
                    $product[$keyValue] = $input[$key];
                }
            }

            $products->push($product);
        }
        $productsGruop = $products->groupBy('product_id');


        $updateCollectionProduct = collect();
        $productItem = collect();
        $finalAmount = 0;
        foreach ($productsGruop->all() as $groupp) {
            foreach ($groupp as $item) {

                $updateCollectionProduct->push(
                    [
                        'product_id' => $item['product_id'],
                        'description' => $item['description']??null,
                        'amount' => 1,
                        'price' => $item['price'],
                        'type' => 'service'
                    ]
                );

            }
            $productItem->push($updateCollectionProduct->last());
        }
        foreach ($productItem->toArray() as $productPrice) {
            $finalAmount += $productPrice['amount'] * $productPrice['price'];
        }
        $invouce = Invoice::create([
            'operator_id' => $user->id,
            'type_of_business' => 'buy',
            'supplier_id' => $request->supplier_id,
            'final_amount' => $finalAmount,
            'description' => $inputs['invoiceDesc']
        ]);
        $invouce->invoiceItem()->createMany($productItem->all());

        return redirect()->route('admin.invoice.service.index')->with(['success' => 'فاکتور جدید شما ایجاد شد و خدمت شما فاکتور گردید']);


    }

    public function serviceEdit(Invoice $invoice)
    {
        Gate::authorize('admin.invoice.service.edit');
        $categories = Category::where('status', 'active')->get();
        $brands = Brand::where("status", 'active')->get();
        $breadcrumbs = Breadcrumbs::render('admin.invoice.service.edit', $invoice)->getData()['breadcrumbs'];
        $products = Product::where('type', 'service')->where('status', 'active')->get();
        $suppliers = Supplier::where('status', 'active')->get();
        return view('Admin.Invoice.Service.edit', compact('suppliers', 'products', 'invoice', 'breadcrumbs','categories','brands'));

    }

    public function serviceUpdate(Invoice $invoice, ServiceRequest $request)
    {
        Gate::authorize('admin.invoice.service.edit');
        DB::beginTransaction();

        try {

            $inputs = $request->all();
            $user = Auth::user();
            $productItems = $this->separationOfArraysFromText($inputs);
            if (!$this->arrayCountValidation($productItems)) {
                return redirect()->route('admin.invoice.service.index')->withErrors(['error' => 'مقدار های داده شده باهم برابر نیست لطفا مجددا تلاش فرمایید']);
            }
            $products = collect();
            foreach ($productItems['product_id'] as $key => $product) {

                $product = [];
                foreach ($productItems as $keyValue => $input) {
                    if (isset($input[$key])) {
                        $product[$keyValue] = $input[$key];
                    }
                }

                $products->push($product);
            }
            $productsGruop = $products->groupBy('product_id');


            $updateCollectionProduct = collect();
            $productItem = collect();
            $finalAmount = 0;
            foreach ($productsGruop->all() as $groupp) {
                $amount = 0;
                foreach ($groupp as $item) {
                    $updateCollectionProduct->push(
                        [
                            'product_id' => $item['product_id'],
                            'description' => $item['description']??null,
                            'amount' => 1,
                            'price' => $item['price'],
                            'type' => 'service'
                        ]
                    );

                }
                $productItem->push($updateCollectionProduct->last());
            }

            foreach ($productItem->toArray() as $productPrice) {
                $finalAmount += $productPrice['amount'] * $productPrice['price'];
            }

            $invoice->invoiceItem->each->delete();
            $invoice->update([
                'operator_id' => $user->id,
                'type_of_business' => 'buy',
                'supplier_id' => $request->supplier_id,
                'final_amount' => $finalAmount,
                'description' => $inputs['invoiceDesc']
            ]);


            $invoice->invoiceItem()->createMany($productItem->all());

            DB::commit();
            return redirect()->route('admin.invoice.service.index')->with(['success' => 'فاکتور  شما یرایش  شد و محصولات شما در انبار اضافه ویرایش گردید']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.invoice.service.index')->withErrors(['updateError' => 'ویرایش فاکتور شما با خطا مواجه شد لطفا مجددا تلاش فرمایید.']);

        }

    }


}
