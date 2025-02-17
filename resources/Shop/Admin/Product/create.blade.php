@extends('Admin.Layout.master')

@section('content')

    <section class="px-5">
        <h1 class="font-bold text-sm">
            ایجاد محصول یا سرویس جدید :
        </h1>
        <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data"
              class="mt-5 space-y-3">
            @csrf

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28"> عنوان محصول :</h5>
                <input type="text" name="title" class="outline-none border border-black rounded-md w-48"
                       value="{{old('title')}}">
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28"> قیمت(ریال) :</h5>
                <input type="text" name="price" class="outline-none border border-black rounded-md w-48"
                       value="{{old('price')}}">
            </div>

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">دستبه بندی:</h5>
                <select name="category_id" id="" class="outline-none border border-black rounded-md w-48">

                    @foreach($categories as $category)
                        <option
                            @selected(old('category_id')==$category->id) value="{{$category->id}}">{{$category->name??''}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">برند :</h5>
                <select name="brand_id" id="" class="outline-none border border-black rounded-md w-48">
                    @foreach($brands as $brand)
                        <option
                            @selected(old('brand_id')==$brand->id) value="{{$brand->id}}">{{$brand->name??""}}</option>
                    @endforeach

                </select>
            </div>
            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">وضعیت:</h5>
                <div class="flex items-center space-x-3 space-x-reverse">
                    <div>
                        <label>فعال</label>
                        <input type="radio" name="status" id="" value="active"
                               @if(old('status')=='active') checked="checked" @endif >

                    </div>
                    <div>
                        <label>غیرفعال</label>
                        <input type="radio" name="status" id="" value="inactive"
                               @if(old('status')=='inactive') checked="checked" @endif >
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">نوع محصول:</h5>
                <div class="flex items-center space-x-3 space-x-reverse">
                    <div>
                        <label>کالا</label>
                        <input type="radio" name="type" value="goods"
                               @if(old('type')=='goods') checked="checked" @endif >

                    </div>
                    <div>
                        <label>سرویس</label>
                        <input type="radio" name="type" id="" value="service"
                               @if(old('type')=='service') checked="checked" @endif >
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

                <input type="file" name="file" class="hidden" id="upload"   onchange="changed(event)">

            </div>

            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">توضیحات:</h5>
            </div>
            <div>
                    <textarea name="description" id="editor1" rows="10" cols="80">
                    </textarea>
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


    <script>
        CKEDITOR.replace( 'editor1' ,{
            versionCheck: false,
            language: 'fa',
            removeButtons: 'Image,Link,Source,About'
        });
    </script>
@endsection
