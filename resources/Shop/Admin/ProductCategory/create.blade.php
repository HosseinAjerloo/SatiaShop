@extends('Admin.Layout.master')

@section('content')

    <section class="px-5">
        <h1 class="font-bold text-sm">
            افزودن کالا :
        </h1>
        <form action="" class="mt-5 space-y-3">
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">نام دسته بندی:</h5>
                <input type="text" name="name" class="outline-none border border-black rounded-md w-48">
            </div>

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">دستبه بندی:</h5>
                <select name="menu_id" id="" class="outline-none border border-black rounded-md w-48">
                    @foreach($menus as $menu)
                        <option value="{{$menu->id}}">{{$menu->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">وضعیت:</h5>
                <div class="flex items-center space-x-3 space-x-reverse">
                    <div>
                        <label>فعال</label>
                        <input type="radio" >
                    </div>
                    <div>
                        <label>غیرفعال</label>
                        <input type="radio" >
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">نمایش:</h5>
                <input type="text" class="outline-none border border-black rounded-md w-14">
            </div>
            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">عکس محصول:</h5>
                <div
                    class="border border-black rounded-md w-14 bg-2081F2 py-1.5 flex items-center justify-center space-x-1 space-x-reverse">
                    <p class="text-min text-white">اپلود</p>
                    <img src="../images/upload.png" alt="">
                </div>
            </div>

            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">توضیحات:</h5>
            </div>
            <div>
                    <textarea name="editor1" id="editor1" rows="10" cols="80">
                    </textarea>
            </div>
        </form>
    </section>


@endsection
@section('script')

        <script>
            CKEDITOR.replace( 'editor1' ,{
            versionCheck: false,
            language: 'fa',
            removeButtons: 'Image,Link,Source,About'
        });


    </script>
@endsection
