<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\BrandRequest;
use App\Models\Brand;
use App\Services\ImageService\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ImageService $imageService)
    {
        $inputs = $request->all();
        $user = Auth::user();
        $imageService->setRootFolder('BrandStore' . DIRECTORY_SEPARATOR . "image");
        $image = $imageService->saveImage($request->file('file'));


        if (!$image)
            return redirect()->route('admin.category.index', 'آپلودعکس به مشکل روبه رو شد');

        $category = Brand::create($inputs);
        if ($category) {
            $category->image()->create([
                'path' => $image,
                'user_id' => $user->id
            ]);
            return redirect()->route('admin.brand.index')->with('success', 'نظیمات  شماویرایش شد');
        } else {
            dd('no');
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
    public function edit(Brand $brand)
    {
        return view('brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, ImageService $imageService, Brand $brand)
    {

        $user = Auth::user();
        $inputs = $request->all();
        if ($request->has('file')) {
            $imageService->setRootFolder('BrandStore' . DIRECTORY_SEPARATOR . "image");
            $imageService->deleteImage($brand->image->path);
            $image = $imageService->saveImage($request->file('file'));
            if (!$image)
                return redirect()->route('admin.category.index', 'آپلودعکس به مشکل روبه رو شد');

            $brand->image()->update([
                'user_id' => $user->id,
                'path' => $image
            ]);
        }
        $brand->update($inputs);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
