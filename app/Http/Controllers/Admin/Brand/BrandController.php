<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\BrandRequest;
use App\Models\Brand;
use App\Services\ImageService\ImageService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        $breadcrumbs = Breadcrumbs::render('admin.brand.index')->getData()['breadcrumbs'];

        return view('Admin.Brand.index', compact('brands','breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = Breadcrumbs::render('admin.brand.create')->getData()['breadcrumbs'];

        return view('Admin.Brand.create',compact('breadcrumbs'));
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
            return redirect()->route('admin.brand.index')->withErrors(['error' => 'آپلودعکس به مشکل روبه رو شد']);

        $brand = Brand::create($inputs);
        if ($brand) {
            $brand->image()->create([
                'path' => $image,
                'user_id' => $user->id
            ]);
            return redirect()->route('admin.brand.index')->with(['success' => 'نظیمات  شماویرایش شد']);
        } else {
            return redirect()->route('admin.brand.index')->withErrors(['error' => 'مشکلی پیش اومد لطفا مجددا تلاش فرمایید.']);
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
        $breadcrumbs = Breadcrumbs::render('admin.brand.edit',$brand)->getData()['breadcrumbs'];
        return view('Admin.Brand.edit', compact('brand','breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, ImageService $imageService, Brand $brand)
    {
        $user = Auth::user();
        $inputs = $request->all();

        if ($request->hasFile('file')) {
            $imageService->setRootFolder('BrandStore' . DIRECTORY_SEPARATOR . "image");
            $image = $imageService->saveImage($request->file('file'));
            if (!$image)
                return redirect()->route('admin.brand.index')->withErrors(['error' => 'آپلود عکس با خطا مواجه شد']);

            if (isset($brand->image->path)) {
                $imageService->deleteImage($brand->image->path);
                $brand->image()->update([
                    'path' => $image,
                    'user_id' => $user->id
                ]);
            } else {
                $brand->image()->create([
                    'path' => $image,
                    'user_id' => $user->id
                ]);
            }
        }
        $result=$brand->update($inputs);
        return $result? redirect()->route('admin.brand.index')->with(['success'=>'برند شما بروز رسانی شد']):redirect()->route('admin.brand.index')->withErrors(['error'=>'خطایی رخ داد لطفا بعدا تلاش فرمایید']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
