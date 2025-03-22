@extends('Admin.Layout.master')

@section('content')

    <section class="px-5">
        <h1 class="font-bold text-sm">
            افزودن دسته بندی :
        </h1>
        <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-3">
            @csrf

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">نام دسته بندی:</h5>
                <input type="text" name="name" class="outline-none border border-black rounded-md w-48" value="{{old('name')}}">
            </div>

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">دسته والد:</h5>
                <select name="category_id" id="" class="outline-none border border-black rounded-md w-48 select2">
                    <option value="">دسته اصلی</option>

                        @foreach($categories as $category)
                            <option @selected(old('category_id')==$category->id) value="{{$category->id}}">{{$category->name??''}}</option>
                        @endforeach
                </select>
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">محل منوی نمایش :</h5>
                <select name="menu_id" id="" class="outline-none border border-black rounded-md w-48 select2">
                    @foreach($menus as $menu)
                        <option @selected(old('menu_id')==$menu->id) value="{{$menu->id}}">{{$menu->name??""}}</option>
                    @endforeach

                </select>
            </div>
            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">وضعیت:</h5>
                <div class="flex items-center space-x-3 space-x-reverse">
                    <div>
                        <label>فعال</label>
                        <input type="radio" name="status" id="" value="active" @if(old('active')=='active') checked="checked" @endif  >

                    </div>
                    <div>
                        <label>غیرفعال</label>
                        <input type="radio" name="status" id="" value="inactive" @if(old('active')=='inactive') checked="checked" @endif  >
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">نمایش:</h5>
                <input type="text" class="outline-none border border-black rounded-md w-14" name="view_sort" value="{{old('view_sort')}}">
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

            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">توضیحات:</h5>
            </div>

            <div class="flex items-center justify-center  w-full">
               <button class="bg-2081F2 rounded-md py-1.5 w-full text-white">ثبت</button>
            </div>
        </form>
    </section>


@endsection
@section('script')
<script>
    $(document).ready(function(){
        var upload=$(".upload");
        $(upload).click(function(){
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
