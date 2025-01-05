<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Models\Setting;
use App\Services\ImageService\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting=Setting::first();
        return view('Setting.index',compact('setting'));

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
        return view('Setting.edit', compact('setting'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, Setting $setting, ImageService $imageService)
    {
        $inputs = $request->all();
        $user = Auth::user();
        if ($request->hasFile('file')) {
            $imageService->setRootFolder('settingStore' . DIRECTORY_SEPARATOR . "image");
            $image = $imageService->saveImage($request->file('file'));
            $status = $setting->image()->create([
                'path' => $image,
                'user_id' => $user->id
            ]);
            if (!$status)
                return redirect()->route('admin.setting.index', 'آپلودعکس به مشکل روبه رو شد');
        }

        $result = $setting->update($inputs);
        return $result ? redirect()->route('admin.setting.index')->with('success', 'نظیمات  شماویرایش شد') : dd('no');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
