@extends('Admin.Layout.master')

@section('content')

    <section class="px-5">
        <h1 class="font-bold text-sm">
            افزودن تامیین کننده :
        </h1>
        <form action="{{route('admin.supplier.update',$supplier->id)}}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-3">
            @csrf
            @method('PUT')
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">نام تامین کننده:</h5>
                <input type="text" name="name" class="outline-none border border-black rounded-md w-48" value="{{old('name',$supplier->name)}}">
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">شماره ثابت:</h5>
                <input type="text" name="phone" class="outline-none border border-black rounded-md w-48" value="{{old('phone',$supplier->phone)}}">
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">شماره موبایل:</h5>
                <input type="text" name="mobile" class="outline-none border border-black rounded-md w-48" value="{{old('mobile',$supplier->mobile)}}">
            </div>

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">دستبه بندی تامین کننده:</h5>
                <select name="supplier_category_id" id="" class="outline-none border border-black rounded-md w-48">

                    @foreach($supplierCategory as $category)
                        <option @selected(old('supplier_category_id',$supplier->supplier_category_id)==$category->id) value="{{$category->id}}">{{$category->name??''}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">وضعیت:</h5>
                <div class="flex items-center space-x-3 space-x-reverse">
                    <div>
                        <label>فعال</label>
                        <input type="radio" name="status" id="" value="active" @if(old('status',$supplier->status)=='active') checked="checked" @endif  >

                    </div>
                    <div>
                        <label>غیرفعال</label>
                        <input type="radio" name="status" id="" value="inactive" @if(old('status',$supplier->status)=='inactive') checked="checked" @endif  >
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">آدرس:</h5>
            </div>
            <div>
                    <textarea name="address" id="editor1" rows="10" cols="80">
                        {{$supplier->address}}
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
        $(document).ready(function(){
            var upload=$(".upload");
            $(upload).click(function(){
                $("#upload").trigger('click')
            })
        })

    </script>
    <script>
        CKEDITOR.replace( 'editor1' ,{
            versionCheck: false,
            language: 'fa',
            removeButtons: 'Image,Link,Source,About'
        });
    </script>
@endsection
