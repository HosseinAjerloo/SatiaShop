@extends('Admin.Layout.master')

@section('content')

    <section class="px-5">
        <h1 class="font-bold text-sm">
            افزودن محصول :
        </h1>
        <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data"
              class="mt-5 space-y-3">
            @csrf
            <section class="pb-3  border-b-2 border-black/40">
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

            <section id="parent" class="space-y-3">

                <article class="space-y-3 border-b-2 border-black/40 pb-3">
                    <div class="flex items-center space-x-reverse space-x-8">
                        <h5 class="text-min font-light w-28"> قیکت هر واحد :</h5>
                        <input type="text" name="price[]" class="outline-none border border-black rounded-md w-48"
                               value="{{old('price')}}">
                    </div>
                    <div class="flex items-center space-x-reverse space-x-8">
                        <h5 class="text-min font-light w-28"> تعداد :</h5>
                        <input type="number" name="amount[]" class="outline-none border border-black rounded-md w-48"
                               value="{{old('amount')}}">
                    </div>

                    <div class="flex items-center space-x-reverse space-x-8">
                        <h5 class="text-min font-light w-28">انتخاب محصول:</h5>
                        <select name="product_id[]" id=""
                                class="productSelect outline-none border border-black rounded-md w-48 w-full">

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
                    <textarea name="description[]" class="product_description w-full" rows="10" cols="80">
                    </textarea>
                    </div>

                </article>

            </section>
            <div class="flex items-center justify-center w-2/5 lg:w-2/6 xl:w-1/5">
                <button type="button" class="btn-copy bg-2081F2 rounded-md py-1.5 w-full text-white">افزودن کالای جدید
                </button>
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

    <script>
        CKEDITOR.replace('invoice_description', {
            versionCheck: false,
            language: 'fa',
            removeButtons: 'Image,Link,Source,About'
        });


        CKEDITOR.replaceClass = function (textarea, config) {

            if (textarea.classList[0] === "product_description") {
                config.versionCheck = false;
                config.language = 'fa';
                return true;

            } else {
                return false;
            }

        }


    </script>



    <script>
        var count = 1;
        $('.btn-copy').click(function () {

            var record = '<article class="space-y-3 border-b-2 border-black/40 pb-3">' +
                '<div class="flex items-center space-x-reverse space-x-8">' +
                '<h5 class="text-min font-light w-28"> قیکت هر واحد :</h5>' +
                '<input type="text" name="price[]" class="outline-none border border-black rounded-md w-48">' +
                '</div>' +
                '<div class="flex items-center space-x-reverse space-x-8">' +
                '<h5 class="text-min font-light w-28"> تعداد :</h5>' +
                '<input type="number" name="amount[]" class="outline-none border border-black rounded-md w-48">' +
                '</div>' +
                '<div class="flex items-center space-x-reverse space-x-8">' +
                '<h5 class="text-min font-light w-28">انتخاب محصول:</h5>' +
                '<select name="product_id[]" id="" class="productSelect outline-none border border-black rounded-md w-48 w-full">' +
                ' ' + SelectProduct() + ' ' +
                '</select>' +
                '</div>' +
                '<div class="flex items-center space-x-reverse space-x-8 ">' +
                '<h5 class="text-min font-light w-48">توضیحات مربوط به محصول</h5>' +
                '</div>' +
                '<div>' +
                '<textarea name="description[]" id="replace_element_' + count + '" class="product_description w-full" rows="10" cols="80">' +
                '</textarea>' +
                '</div>' +
                '<div class="flex items-center justify-center w-2/5 lg:w-2/6 xl:w-1/5 remove">' +
                '<button type="button" class="bg-red-600 rounded-md py-1.5 w-full text-white">حذف کردن</button>' +
                '</div>' +
                '</article>'
            $("#parent").append(record)
            changeFunction()
            FilterSelectProduct()
            elementFunction()

            CKEDITOR.replace('replace_element_' + count, {
                versionCheck: false,
                language: 'fa',
                removeButtons: 'Image,Link,Source,About'
            });
            count += 1;


        })
        var productSelect = [];

        function elementFunction() {
            $(".remove").click(function () {


                $(this).parent().remove()
                changeFunction()
                FilterSelectProduct()
            })

        }


        function SelectProduct() {
            let html = "";
            var products =@json($products->toArray());


            $.each(products, function (index, value) {
                if (!productSelect.includes(value.id + '')) {
                    html += "<option value='" + value.id + "' " + ((value.id) % 2 == 0 ? 'selected=selected' : '') + " >" + value.title + "</option>"
                }

            })
            return html;
        }


        function FilterSelectProduct() {

            productSelect = [];
            var selection = $('.productSelect');

            $.each(selection, function (index, value) {

                productSelect.push($(value).val())
            })


            var products =@json($products->toArray());

            $.each(selection, function (index, value) {

                var select = $(value).val();
                $(value).empty()


                $.each(products, function (productsIndex, productsIndexValue) {
                    if (select === productsIndexValue.id + '') {
                        $(value).append("<option value='" + productsIndexValue.id + "' selected='selected'>" + productsIndexValue.title + "</option>")
                    }

                    if (!productSelect.includes(productsIndexValue.id + '')) {
                        $(value).append("<option value='" + productsIndexValue.id + "'>" + productsIndexValue.title + "</option>")

                    }

                })


            })



        }

        FilterSelectProduct()

        function changeFunction() {
            var selection = $('.productSelect');


            $(selection).change(function () {
                FilterSelectProduct();
            })
        }
        changeFunction()
    </script>
@endsection
