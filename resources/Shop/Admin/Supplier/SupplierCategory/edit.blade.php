@extends('Admin.Layout.master')

@section('content')
    <section class="px-5">
        <h1 class="font-bold text-sm">
            ویرایش دسته‌بندی تامین‌کننده:
        </h1>
        <form action="{{route('admin.supplier.category.update', $category->id)}}" method="POST" class="mt-5 space-y-3">
            @csrf
            @method('PUT')
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">نام دسته‌بندی:</h5>
                <input type="text" name="name" class="outline-none border border-black rounded-md w-48" value="{{old('name', $category->name)}}">
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">وضعیت:</h5>
                <select name="status" class="outline-none border border-black rounded-md w-48">
                    <option value="active" @selected(old('status', $category->status) == 'active')>فعال</option>
                    <option value="inactive" @selected(old('status', $category->status) == 'inactive')>غیرفعال</option>
                </select>
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">بروزرسانی:</h5>
                <button type="submit" class="border border-black rounded-md px-2 bg-2081F2 py-1.5 flex items-center justify-center space-x-1 space-x-reverse">
                    <p class="text-min text-white font-bold">بروزرسانی</p>
                    <img src="{{asset('capsule/images/update.svg')}}" alt="" class="w-5">
                </button>
            </div>
        </form>

        <div class="mt-8">
            <form action="{{route('admin.supplier.category.destroy', $category->id)}}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <div class="flex items-center space-x-reverse space-x-8">
                    <h5 class="text-min font-light w-28">حذف دسته‌بندی:</h5>
                    <button type="submit" class="border border-black rounded-md px-2 bg-red-500 py-1.5 flex items-center justify-center space-x-1 space-x-reverse">
                        <p class="text-min text-white font-bold">حذف کردن</p>
                        <img src="{{asset('capsule/images/delete.svg')}}" alt="" class="w-5">
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection 