<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Models\Setting;
use App\Services\ImageService\ImageService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('admin.setting.index');
        $setting=Setting::first();
        $breadcrumbs=Breadcrumbs::render('admin.setting.index')->getData()['breadcrumbs'];

        return view('Admin.Setting.index',compact('setting','breadcrumbs'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Setting $setting)
    {
        Gate::authorize('admin.setting.edit');
        $breadcrumbs=Breadcrumbs::render('admin.setting.edit',$setting)->getData()['breadcrumbs'];
        return view('Admin.Setting.edit', compact('setting','breadcrumbs'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, Setting $setting, ImageService $imageService)
    {
        Gate::authorize('admin.setting.edit');
        $inputs = $request->all();
        $user = Auth::user();
        if ($request->hasFile('file')) {
            $imageService->setRootFolder('settingStore' . DIRECTORY_SEPARATOR . "image");
            $image = $imageService->saveImage($request->file('file'));
            if (isset($setting->image->path))
                $imageService->deleteImage($setting->image->path);
            $status = $setting->image()->update([
                'path' => $image,
                'user_id' => $user->id
            ]);
            if (!$status)
                return redirect()->route('admin.setting.index', 'آپلودعکس به مشکل روبه رو شد');
        }

        $result = $setting->update($inputs);
        return $result ? redirect()->route('admin.setting.index')->with(['success'=> 'نظیمات  شماویرایش شد']) :redirect()->route('admin.setting.index')->withErrors(['error'=> 'خطایی رخ داد لطفا بعدا تلاش فرمایید']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
