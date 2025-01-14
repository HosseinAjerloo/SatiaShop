<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Invoice\InvoiceRequest;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Supplier;
use App\Services\ImageService\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('Admin.Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        $suppliers = Supplier::where('status', 'active')->get();
        return view('Product.create', compact('categories', 'suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        $user = Auth::user();
        $productItems = array_filter($inputs, function ($value) use ($inputs) {
            if (is_array($value)) {
                return $value;
            }
        });
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
                        'price' => $item['price']
                    ]
                );

            }
            $productItem->push($updateCollectionProduct->last());
        }

        foreach ($productItem->toArray() as $productPrice) {
            $finalAmount += $productPrice['amount'] * $productPrice['price'];
        }
        $invouce = Invoice::create([
            'user_id' => $user->id,
            'type_of_business' => 'buy',
            'supplier_id' => $request->supplier_id,
            'final_amount' => $finalAmount,
            'description' => 'invoiceDescription'
        ]);
        $invouce->invoiceItem()->createMany($productItem->all());
        foreach ($productItem as $itemTransaction) {
            $productTransaction=ProductTransaction::where('product_id',$itemTransaction['product_id'])->latest()->first();
            $itemTransaction['type']='add';
            $itemTransaction['remain']=$itemTransaction['amount'];
            $itemTransaction['user_id']=$user->id;
            if ($productTransaction)
            {
                $itemTransaction['remain']=$itemTransaction['amount']+$productTransaction->remain;
            }
            $invouce->productTransaction()->create($itemTransaction);
        }
        dd($invouce);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status', 'active')->get();
        $brands = Brand::where("status", 'active')->get();
        return view('Admin.Product.edit', compact('categories', 'brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product, ImageService $imageService)
    {
        $inputs = $request->all();
        $user = Auth::user();
        if ($request->hasFile('file')) {


            $imageService->setRootFolder('ProductStore' . DIRECTORY_SEPARATOR . "image");
            $image = $imageService->saveImage($request->file('file'));
            if (!$image)
                return redirect()->route('admin.product.index')->withErrors(['error' => 'آپلود عکس با خطا مواجه شد']);

            if (isset($product->images->path)) {
                $imageService->deleteImage($product->images->path);

                $product->images()->update([
                    'path' => $image,
                    'user_id' => $user->id
                ]);

            } else {
                $product->images()->create([
                    'path' => $image,
                    'user_id' => $user->id
                ]);
            }


        }
        $product = $product->update($inputs);
        if ($product) {
            return redirect()->route('admin.product.index')->with(['success' => 'محصول ویرایش شد']);
        } else {
            return redirect()->route('admin.product.index')->withErrors(['error' => 'ویرایش محصول با خطا مواجه شد']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
