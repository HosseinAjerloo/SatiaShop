@extends('Admin.Layout.master')

@section('content')

    <section class="px-5">
        <h1 class="font-bold text-sm">
            ویرایش برند :
        </h1>
        <form action="{{route('admin.brand.update',$brand->id)}}" method="POST" enctype="multipart/form-data"
              class="mt-5 space-y-3">
            @csrf
            @method('PUT')
            @isset($brand->image->path)
                <div class="flex items-center space-x-reverse space-x-8">
                    <h5 class="text-min font-light w-28">عکس فعلی:</h5>
                    <div class="border border-black rounded-md w-48 h-48">
                        <img src="{{asset($brand->image->path)??''}}" alt="" class="w-full h-full rounded-md">
                    </div>
                </div>
            @endisset
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">نام برند:</h5>
                <input type="text" name="name" class="outline-none border border-black rounded-md w-48"
                       value="{{old('name',$brand->name)}}">
            </div>


            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">وضعیت:</h5>
                <div class="flex items-center space-x-3 space-x-reverse">
                    <div>
                        <label>فعال</label>
                        <input type="radio" name="status" id="" value="active"
                               @if(old('status',$brand->status)=='active') checked="checked" @endif >

                    </div>
                    <div>
                        <label>غیرفعال</label>
                        <input type="radio" name="status" id="" value="inactive"
                               @if(old('status',$brand->status)=='inactive') checked="checked" @endif >
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">عکس محصول:</h5>
                <div
                    class="upload border border-black rounded-md w-14 bg-2081F2 py-1.5 flex items-center justify-center space-x-1 space-x-reverse">
                    <p class="text-min text-white">اپلود</p>
                    <img src="{{asset('capsule/images/upload.png')}}" alt="">
                </div>
                <p class="text-base text-green-500 file-name"></p>

                <input type="file" name="file" class="hidden" id="upload" onchange="changed(event)">
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

        let fileName=document.getElementsByClassName('file-name');
        function  changed(event){
            if(event.target.files[0])
            {
                fileName[0].textContent=event.target.files[0].name
            }
        }
    </script>

@endsection
