@extends('Admin.Layout.master')

@section('content')

    <section class="px-5">
        <h1 class="font-bold text-sm">
            افزودن محصول :
        </h1>
        <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data"
              class="mt-5 space-y-3">
            @csrf
            <section class="pb-3 border-b border-b-2 border-black/40">
                <div class="flex items-center space-x-reverse space-x-8">
                    <h5 class="text-min font-light w-28">تامین کنندگان:</h5>
                    <select name="category_id" id="" class="outline-none border border-black rounded-md w-48">

                        @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center space-x-reverse space-x-8 ">
                    <h5 class="text-min font-light w-48">توضیحات مربوط به فاکتور</h5>
                </div>
                <div>
                    <textarea name="description" id="invoice_description" rows="10" cols="80">
                    </textarea>
                </div>
            </section>

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28"> قیکت هر واحد :</h5>
                <input type="text" name="price[]" class="outline-none border border-black rounded-md w-48"
                       value="{{old('price')}}">
            </div>

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">انتخاب محصول:</h5>
                <select name="category_id" id="" class="outline-none border border-black rounded-md w-48 w-full">

                    @foreach($products as $product)
                        <option @if($product->id==1) selected="selected"
                                @endif  value="{{$product->id}}">{{$product->title}}</option>
                    @endforeach
                </select>
            </div>


            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-48">توضیحات مربوط به محصول</h5>
            </div>
            <div>
                    <textarea name="description" class="product_description w-full" rows="10" cols="80">
                    </textarea>
            </div>

            <div class="flex items-center justify-center  w-full">
                <button class="bg-2081F2 rounded-md py-1.5 w-full text-white">ارسال</button>
            </div>
            <div class="flex items-center justify-center w-2/5 lg:w-2/6 xl:w-1/5">
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


    <script>
        CKEDITOR.replace('invoice_description', {
            versionCheck: false,
            language: 'fa',
            removeButtons: 'Image,Link,Source,About'
        });

        CKEDITOR.replace('.product_description', {
            versionCheck: false,
            language: 'fa',
            removeButtons: 'Image,Link,Source,About'
        });
    </script>
@endsection
