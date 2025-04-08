@extends('Admin.Layout.master')

@section('content')
    <section class="px-5">
        <h1 class="font-bold text-sm">
            افزودن دسته‌بندی تامین‌کننده:
        </h1>
        <form action="{{route('admin.supplier.category.store')}}" method="POST" class="mt-5 space-y-3">
            @csrf
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">نام دسته‌بندی:</h5>
                <input type="text" name="name" class="outline-none border border-black rounded-md w-48" value="{{old('name')}}">
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">وضعیت:</h5>
                <select name="status" class="outline-none border border-black rounded-md w-48">
                    <option value="active" @selected(old('status') == 'active')>فعال</option>
                    <option value="inactive" @selected(old('status') == 'inactive')>غیرفعال</option>
                </select>
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <button type="submit" class="bg-2081F2 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    ذخیره
                </button>
            </div>
        </form>
    </section>
@endsection 