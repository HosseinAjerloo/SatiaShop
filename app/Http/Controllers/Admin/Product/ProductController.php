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
use Diglactic\Breadcrumbs\Breadcrumbs;
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
        $breadcrumbs=Breadcrumbs::render('admin.product.index')->getData()['breadcrumbs'];

        return view('Admin.Product.index', compact('products','breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        $brands = Brand::where("status", 'active')->get();
        $breadcrumbs=Breadcrumbs::render('admin.product.create')->getData()['breadcrumbs'];

        return view('Admin.Product.create', compact('categories', 'brands','breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, ImageService $imageService)
    {

        $inputs = $request->all();
        $user = Auth::user();
        $inputs['user_id'] = $user->id;
        $product = Product::create($inputs);
        $imageService->setRootFolder('ProductStore' . DIRECTORY_SEPARATOR . "image");
        $image = $imageService->saveImage($request->file('file'));

        if (!$image)
            return redirect()->route('admin.product.index')->withErrors(['error' => 'آپلود عکس با خطا مواجه شد']);


        $product->image()->create([
            'path' => $image,
            'user_id' => $user->id
        ]);

        if ($product) {
            return redirect()->route('admin.product.index')->with(['success' => 'محصول جدید شما اضافه  شد']);
        } else {
            return redirect()->route('admin.product.index')->withErrors(['error' => 'افزودن محصول با خطا مواجه شد']);
        }
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
        $breadcrumbs=Breadcrumbs::render('admin.product.edit',$product)->getData()['breadcrumbs'];

        return view('Admin.Product.edit', compact('categories', 'brands', 'product','breadcrumbs'));
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
                $product->image()->update([
                    'path' => $image,
                    'user_id' => $user->id
                ]);

            } else {
                $product->image()->create([
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
