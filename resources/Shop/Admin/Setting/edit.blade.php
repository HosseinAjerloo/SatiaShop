@extends('Admin.Layout.master')

@section('content')

    <section class="px-5">
        <h1 class="font-bold text-sm">
            ویرایش دسته بندی :
        </h1>
        <form action="{{route('admin.setting.update',$setting->id)}}" method="POST" enctype="multipart/form-data"
              class="mt-5 space-y-3">
            @csrf
            @method('PUT')
            @isset($setting->image->path)
                <div class="flex items-center space-x-reverse space-x-8">
                    <h5 class="text-min font-light w-28">عکس فعلی:</h5>
                    <div class="border border-black rounded-md w-48 h-48">
                        <img src="{{asset($setting->image->path)??''}}" alt="" class="w-full h-full rounded-md">
                    </div>
                </div>
            @endisset
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">نام برنامه:</h5>
                <input type="text" name="name" class="outline-none border border-black rounded-md w-48"
                       value="{{old('name',$setting->name)}}">
            </div>


            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">عکس محصول:</h5>
                <div
                    class="upload border border-black rounded-md w-14 bg-2081F2 py-1.5 flex items-center justify-center space-x-1 space-x-reverse">
                    <p class="text-min text-white">اپلود</p>
                    <img src="{{asset('capsule/images/upload.png')}}" alt="">
                </div>
                <input type="file" name="file" class="hidden" id="upload">
            </div>
            <div class="flex items-center justify-center  w-full">
                <button class="bg-2081F2 rounded-md py-1.5 w-full text-white">ارسال</button>
            </div>
        </form>
    </section>

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var upload = $(".upload");
            $(upload).click(function () {
                $("#upload").trigger('click')
            })
        })
    </script>

@endsection
