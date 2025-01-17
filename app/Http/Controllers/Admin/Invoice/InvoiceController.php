<?php

namespace App\Http\Controllers\Admin\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Invoice\InvoiceRequest;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Http\Traits\HasProduct;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Supplier;
use App\Services\ImageService\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    use HasProduct;
    public function index()
    {
        $invoices=Invoice::where('type_of_business','buy')->get();
        return view('Admin.Invoice.index',compact('invoices'));
    }
    public function invoiceProduct(Invoice $invoice)
    {
        return view('Admin.Invoice.Product.index', compact('invoice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        $products = Product::where('type','goods')->get();
        $suppliers = Supplier::where('status', 'active')->get();
        return view('Admin.Invoice.create', compact('categories', 'suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        $user = Auth::user();
        $productItems = $this->separationOfArraysFromText($inputs);
        if (!$this->arrayCountValidation($productItems))
        {
            return redirect()->route('admin.invoice.product.index')->withErrors(['error'=>'مقدار های داده شده باهم برابر نیست لطفا مجددا تلاش فرمایید']);
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
                        'type'=>'product'
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
        return redirect()->route('admin.invoice.product.index')->withErrors(['success'=>'فاکتور جدید شما ایجاد شد و محصولات شما به انبار اضافه گردید']);




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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
