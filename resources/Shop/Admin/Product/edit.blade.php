@extends('Admin.Layout.master')

@section('content')

    <section class="px-5">
        <h1 class="font-bold text-sm">
            ویرایش محصول یا سرویس :
        </h1>
        <form action="{{route('admin.product.update',$product->id)}}" method="POST" enctype="multipart/form-data"
              class="mt-5 space-y-3">
            @csrf
            @method('PUT')
            @isset($product->image->path)
                <div class="flex items-center space-x-reverse space-x-8">
                    <h5 class="text-min font-light w-28">عکس فعلی:</h5>
                    <div class="border border-black rounded-md w-48 h-48">
                        <img src="{{asset($product->image->path)??''}}" alt="" class="w-full h-full rounded-md">
                    </div>
                </div>
            @endisset
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28"> عنوان محصول :</h5>
                <input type="text" name="title" class="outline-none border border-black rounded-md w-48"
                       value="{{old('title',$product->removeUnderLine)}}">
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28"> قیمت(ریال) :</h5>
                <input type="text" name="price" class="outline-none border border-black rounded-md w-48"
                       value="{{old('price',$product->price)}}">
            </div>

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">دستبه بندی:</h5>
                <select name="category_id" id="" class="outline-none border border-black rounded-md w-48 select2">

                    @foreach($categories as $category)
                        @if(!str_contains($category->removeUnderline,'کالای مبوط'))
                            <option
                                @selected(old('category_id',$product->category_id)==$category->id) value="{{$category->id}}">{{$category->removeUnderLine??''}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">خدمات مربوط:</h5>
                <select name="related_goods" id="" class="outline-none border border-black rounded-md w-48 select2">
                    <option value="">انتخاب کنید</option>
                    @foreach($categories as $category)
                        @if(str_contains($category->removeUnderline,'کالای مبوط'))
                            <option
                                @selected(old('related_goods',$product->related_goods)==$category->id) value="{{$category->id}}">{{$category->removeUnderLine??''}}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">برند :</h5>
                <select name="brand_id" id="" class="outline-none border border-black rounded-md w-48 select2">
                    @foreach($brands as $brand)
                        <option
                            @selected(old('menu_id',$product->brand_id)==$brand->id) value="{{$brand->id}}">{{$brand->name??""}}</option>
                    @endforeach

                </select>
            </div>
            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">وضعیت:</h5>
                <div class="flex items-center space-x-3 space-x-reverse">
                    <div>
                        <label>فعال</label>
                        <input type="radio" name="status" id="" value="active"
                               @if(old('status',$product->status)=='active') checked="checked" @endif >

                    </div>
                    <div>
                        <label>غیرفعال</label>
                        <input type="radio" name="status" id="" value="inactive"
                               @if(old('status',$product->status)=='inactive') checked="checked" @endif >
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">نوع محصول:</h5>
                <div class="flex items-center space-x-3 space-x-reverse">
                    <div>
                        <label>کالا</label>
                        <input type="radio" name="type" value="goods"
                               @if(old('type',$product->type)=='goods') checked="checked" @endif >

                    </div>
                    <div>
                        <label>سرویس</label>
                        <input type="radio" name="type" id="" value="service"
                               @if(old('type',$product->type)=='service') checked="checked" @endif >
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">افزودن به علاقه مندی:</h5>
                <div class="flex items-center space-x-3 space-x-reverse">
                    <div>
                        <input type="hidden" name="is_favorite" id="is_favorite"
                               value="{{old('is_favorite',$product->is_favorite)}}">
                        <img
                            src="{{old('is_favorite',$product->is_favorite)==1 ? asset('capsule/images/Group 2948.svg') : asset('capsule/images/Group 2949.svg')}}"
                            class="w-5 cursor-pointer favorite-star" id="favorite-star"
                            data-active="{{asset('capsule/images/Group 2948.svg')}}"
                            data-inactive="{{asset('capsule/images/Group 2949.svg')}}">
                    </div>
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

            <a href="{{route('admin.product.destroy',$product)}}" class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">حذف محصول:</h5>
                <div
                    class=" border border-black rounded-md px-2 bg-red-500 py-1.5 flex items-center justify-center space-x-1 space-x-reverse">
                    <p class="text-min text-white font-bold">حذف کردن</p>
                    <img src="{{asset('capsule/images/delete.svg')}}" alt="" class="w-5">
                </div>
            </a>
            <div>
                    <textarea name="description" id="editor1" rows="10" cols="80">
                        {{$product->description??''}}
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

            // اسکریپت برای تغییر وضعیت ستاره علاقه‌مندی
            $(".favorite-star").click(function () {
                var isFavorite = $("#is_favorite").val();
                var activeImg = $(this).data('active');
                var inactiveImg = $(this).data('inactive');

                if (isFavorite == 1) {
                    $("#is_favorite").val(0);
                    $(this).attr('src', inactiveImg);
                } else {
                    $("#is_favorite").val(1);
                    $(this).attr('src', activeImg);
                }
            });
        })

        let fileName = document.getElementsByClassName('file-name');

        function changed(event) {
            if (event.target.files[0]) {
                fileName[0].textContent = event.target.files[0].name
            }
        }
    </script>


    <script>
        CKEDITOR.replace('editor1', {
            versionCheck: false,
            language: 'fa',
            removeButtons: 'Image,Link,Source,About'
        });
    </script>
@endsection
