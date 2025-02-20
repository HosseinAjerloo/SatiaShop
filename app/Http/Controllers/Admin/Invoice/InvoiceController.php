<?php

namespace App\Http\Controllers\Admin\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Invoice\InvoiceRequest;
use App\Http\Requests\Admin\Invoice\ServiceRequest;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Http\Traits\HasProduct;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Supplier;
use App\Services\ImageService\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    use HasProduct;


    public function productIndex()
    {
        $invoice = InvoiceItem::where('type', 'product')->get()->unique('invoice_id')->pluck('invoice_id');
        $invoices = Invoice::where('type_of_business', 'buy')->whereIn('id', $invoice)->get();
        return view('Admin.Invoice.Product.index', compact('invoices'));
    }

    public function invoiceProduct(Invoice $invoice)
    {
        return view('Admin.Invoice.Product.itemProductIndex', compact('invoice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $products = Product::where('type', 'goods')->where('status', 'active')->get();
        $suppliers = Supplier::where('status', 'active')->get();
        return view('Admin.Invoice.Product.create', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request)
    {
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
                        'description' => $item['description'],
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

    public function editProduct(Invoice $invoice)
    {
        $products = Product::where('type', 'goods')->where('status', 'active')->get();
        $suppliers = Supplier::where('status', 'active')->get();
        return view('Admin.Invoice.Product.edit', compact('suppliers', 'products', 'invoice'));

    }

    public function updateProduct(InvoiceRequest $request, Invoice $invoice)
    {
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
            $product['id'] = str_contains($key, "id:") ? explode(":", $key)[1] : null;


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
                        'description' => $item['description'],
                        'amount' => $amount,
                        'price' => $item['price'],
                        'type' => 'product',
                        'id' => $item['id']
                    ]
                );

            }
            $productItem->push($updateCollectionProduct->last());
        }

        foreach ($productItem->toArray() as $productPrice) {
            $finalAmount += $productPrice['amount'] * $productPrice['price'];
        }
        $invoice->update([
            'operator_id' => $user->id,
            'type_of_business' => 'buy',
            'supplier_id' => $request->supplier_id,
            'final_amount' => $finalAmount,
            'description' => $inputs['invoiceDesc']
        ]);

        foreach ($productItem as $itemTransaction) {
            $itemTransaction['type'] = 'edit';
            $itemTransaction['remain'] = $itemTransaction['amount'];
            $itemTransaction['user_id'] = $user->id;

            $invoice->productTransaction()->create($itemTransaction);
            if ($itemTransaction['id']) {
                InvoiceItem::find($itemTransaction['id'])->update($itemTransaction);
            } else {
                $invoice->invoiceItem()->create($itemTransaction);
            }
        }
        return redirect()->route('admin.invoice.product.index')->with(['success' => 'فاکتور  شما یرایش  شد و محصولات شما در انبار اضافه ویرایش گردید']);


    }

    public function serviceIndex()
    {
        $invoice = InvoiceItem::where('type', 'service')->get()->unique('invoice_id')->pluck('invoice_id');
        $invoices = Invoice::where('type_of_business', 'buy')->whereIn('id', $invoice)->get();
        return view('Admin.Invoice.Service.index', compact('invoices'));
    }

    public function invoiceService()
    {

    }


    public function serviceCreate()
    {
        $products = Product::where('type', 'service')->where('status', 'active')->get();
        $suppliers = Supplier::where('status', 'active')->get();
        return view('Admin.Invoice.Service.create', compact('suppliers', 'products'));
    }

    public function serviceStore(ServiceRequest $request)
    {
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
                        'description' => $item['description'],
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

    public function serviceEdit()
    {

    }

    public function serviceUpdate()
    {

    }
}
