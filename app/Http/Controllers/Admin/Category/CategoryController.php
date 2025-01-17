<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Models\Category;
use App\Models\Menu;
use App\Services\ImageService\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('Admin.ProductCategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::where("status", 'active')->get();
        $categories = Category::where("status", 'active')->get();
        return view('Admin.ProductCategory.create', compact('menus', 'categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        $user = Auth::user();
        $imageService->setRootFolder('CategoryStore' . DIRECTORY_SEPARATOR . "image");
        $image = $imageService->saveImage($request->file('file'));


        if (!$image)
            return redirect()->route('admin.category.index')->withErrors(['error' => 'آپلود عکس با خطا مواجه شد']);


        $category = Category::create($inputs);
        if ($category) {
            $category->image()->create([
                'path' => $image,
                'user_id' => $user->id
            ]);
            return redirect()->route('admin.category.index')->with(['success' => 'دسته بندی شما ایجاد شد']);
        } else {
            return redirect()->route('admin.category.index')->withErrors(['error' => 'ایجاد دسته بندی با خطا مواجه شد']);
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
    public function edit(Category $category)
    {
        $menus = Menu::where("status", 'active')->get();
        $categories = Category::where("status", 'active')->get()->except($category->id);
        return view('Admin.ProductCategory.edit', compact('menus', 'categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category, ImageService $imageService)
    {
        $inputs = $request->all();
        $user = Auth::user();

        if ($request->hasFile('file')) {
            $imageService->setRootFolder('CategoryStore' . DIRECTORY_SEPARATOR . "image");
            $image = $imageService->saveImage($request->file('file'));
            if (!$image)
                return redirect()->route('admin.category.index')->withErrors(['error' => 'آپلود عکس با خطا مواجه شد']);

            if (isset($category->image->path)) {
                $imageService->deleteImage($category->image->path);
                $category->image()->update([
                    'path' => $image,
                    'user_id' => $user->id
                ]);
            } else {
                $category->image()->create([
                    'path' => $image,
                    'user_id' => $user->id
                ]);
            }
        }
        $category =$category->update($inputs);
        if ($category) {
            return redirect()->route('admin.category.index')->with(['success' => 'دسته بندی شما ویرایش شد']);
        } else {
            return redirect()->route('admin.category.index')->withErrors(['error' => 'ویرایش دسته بندی با خطا مواجه شد']);
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
