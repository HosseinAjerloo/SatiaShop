@extends('Admin.Layout.master')

@section('content')

    <section class="px-5 relative">
        <h1 class="font-bold text-sm">
            افزودن  فاکتور سرویس :
        </h1>


        <form action="{{route('admin.invoice.service.store')}}" method="POST" enctype="multipart/form-data"
              class="mt-5 space-y-3">
            @csrf
            <section class="pb-3  border-b-2 border-black/40">
                <div class="flex items-center space-x-reverse space-x-8">
                    <h5 class="text-min font-light w-28">تامین کنندگان:</h5>
                    <select name="supplier_id"  class="outline-none border border-black rounded-md w-48 select2">

                        @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center space-x-reverse space-x-8 ">
                    <h5 class="text-min font-light w-48">توضیحات مربوط به فاکتور</h5>
                </div>
                <div>
                    <textarea name="invoiceDesc" class="desc" rows="10" cols="80"></textarea>
                </div>
            </section>

            <section id="parent" class="space-y-12">
                @if($errors->any())
                    @php
                        $length=count(old('product_id'));
                        $reversItems=array_reverse(separationOfArraysFromText(old()));

                    @endphp

                    @for($i=0;$i<$length;$i++)
                        <article class="space-y-3  shadow-lg p-4 shadow-gray-700 rounded-lg transition">

                            <div class="flex items-center space-x-reverse space-x-8">
                                <h5 class="text-min font-light w-28">انتخاب محصول:</h5>
                                <select name="product_id[]"
                                        class="productSelect outline-none border border-black rounded-md w-48 product-select select2">

                                    @foreach($products as $product)
                                        <option @if(separationOfArraysFromText(old())['product_id'][$i]==$product->id) selected="selected"
                                                @endif  value="{{$product->id}}">{{$product->removeUnderLine}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center space-x-reverse space-x-8">
                                <h5 class="text-min font-light w-28"> قیمت هر واحد(ریال):</h5>
                                <input type="text" name="price[]"
                                       class="outline-none border border-black rounded-md w-48"
                                       value="{{separationOfArraysFromText(old())['price'][$i]}}">
                            </div>





                            <div class="flex items-center space-x-reverse space-x-8 ">
                                <h5 class="text-min font-light w-48">توضیحات مربوط به محصول</h5>
                            </div>
                            <div>
                        <textarea name="description[]"  class="w-full desc" rows="10"
                                  cols="80">{{separationOfArraysFromText(old())['description'][$i]}}</textarea>
                            </div>

                        </article>

                    @endfor
                @else
                    <article class="space-y-3  shadow-lg p-4 shadow-gray-700 rounded-lg transition ">

                        <div class="flex items-center space-x-reverse space-x-8">
                            <h5 class="text-min font-light w-28">انتخاب محصول:</h5>
                            <select name="product_id[]"
                                    class="productSelect outline-none border border-black rounded-md w-48  product-select select2">

                                @foreach($products as $product)
                                    <option @if($product->id==1) selected="selected"
                                            @endif  value="{{$product->id}}">{{$product->removeUnderLine}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center space-x-reverse space-x-8">
                            <h5 class="text-min font-light w-28"> قیمت هر واحد(ریال):</h5>
                            <input type="text" name="price[]" class="outline-none border border-black rounded-md w-48">
                        </div>





                        <div class="flex items-center space-x-reverse space-x-8 ">
                            <h5 class="text-min font-light w-48">توضیحات مربوط به محصول</h5>
                        </div>
                        <div>
                        <textarea name="description[]"  class="w-full desc" rows="10"
                                  cols="80"></textarea>
                        </div>

                    </article>

                @endif

            </section>
            <div class="flex items-center justify-center  w-full md:w-2/5  space-x-reverse space-x-2">
                <button type="button"
                        class="btn-copy bg-2081F2 rounded-md py-1.5 w-full text-white text-sm lg:text-base">افزودن سرویس
                    جدید به فاکتور
                </button>
                <button type="button"
                        class=" bg-green-400 rounded-md py-1.5 w-full text-white text-sm lg:text-base plus">
                    افزودن کالای جدید
                </button>
            </div>
            <div class="flex items-center justify-center  w-full">
                <button class="bg-2081F2 rounded-md py-1.5 w-full text-white">ارسال</button>
            </div>

        </form>


        <article class=" circle-page invisible  absolute w-full rounded-md h-full top-0 bg-black/65 ">
            <div
                class="absolute  top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] shadow bg-white p-2 rounded-md w-11/12">
                <div class="flex items-center justify-between">
                    <h1 class="p-1 font-bold">
                        افزودن سرویس جدید :
                    </h1>
                    <img src="{{asset("capsule/images/close.svg")}}" alt="" class="close-page cursor-pointer">
                </div>
                <form class="mt-5 space-y-3" id="product-form">


                    <div class="flex items-center space-x-reverse space-x-8">
                        <h5 class="text-min font-light w-28"> عنوان محصول :</h5>
                        <input type="text" name="title" class="outline-none border border-black rounded-md w-48"
                               value="{{old("title")}}">
                    </div>
                    <div class="flex items-center space-x-reverse space-x-8">
                        <h5 class="text-min font-light w-28">قیمت فروش(ریال) :</h5>
                        <input type="text" name="product-price" class="outline-none border border-black rounded-md w-48"
                               value="{{old('product-price')}}">
                    </div>
                    <div class="flex items-center space-x-reverse space-x-8">
                        <h5 class="text-min font-light w-28">قیمت اجرت(ریال) :</h5>
                        <input type="text" name="salary" class="outline-none border border-black rounded-md w-48"
                               value="{{old('salary')}}">
                    </div>

                    <div class="flex items-center space-x-reverse space-x-8">
                        <h5 class="text-min font-light w-28">دستبه بندی:</h5>
                        <select name="category_id"
                                class="outline-none border border-black rounded-md w-48 select2">

                            @foreach($categories as $category)
                                <option
                                    @selected(old('category_id')==$category->id) value="{{$category->id}}
                                ">{{$category->removeUnderLine??''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center space-x-reverse space-x-8">
                        <h5 class="text-min font-light w-28">خدمات مربوط:</h5>
                        <select name="related_goods"
                                class="outline-none border border-black rounded-md w-48 select2">
                            <option selected="selected" value="null">
                                انتخاب کنید
                            </option>
                            @foreach($categories as $category)
                                @if(str_contains($category->removeUnderline,'کالای مربوط'))
                                    <option
                                        @selected(old('related_goods')==$category->id) value="{{$category->id}}">{{$category->removeUnderLine??''}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center space-x-reverse space-x-8">
                        <h5 class="text-min font-light w-28">برند :</h5>
                        <select name="brand_id"  class="outline-none border border-black rounded-md w-48 select2">
                            @foreach($brands as $brand)
                                <option
                                    @selected(old('brand_id')==$brand->id) value="{{$brand->id}}
                                ">{{$brand->name??""}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="flex items-center space-x-reverse space-x-8 ">
                        <h5 class="text-min font-light w-28">وضعیت:</h5>
                        <div class="flex items-center space-x-3 space-x-reverse">
                            <div>
                                <label>فعال</label>
                                <input type="radio" name="status"  value="active"
                                       @if(old('status')=='active') checked="checked" @endif >

                            </div>
                            <div>
                                <label>غیرفعال</label>
                                <input type="radio" name="status"  value="inactive"
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
                                <input type="radio" name="type"  value="service"
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

                        <input type="file" name="file" class="hidden" id="upload" onchange="changed(event)">

                    </div>

                    <div class="flex items-center space-x-reverse space-x-8 ">
                        <h5 class="text-min font-light w-28">توضیحات:</h5>
                    </div>
                    <div>
                        <textarea class="desc" id="product_description" rows="10" cols="80">

                        </textarea>
                    </div>

                    <div class="flex items-center justify-center  w-full">
                        <button class="bg-2081F2 rounded-md py-1.5 w-full text-white append-product">ثبت</button>
                    </div>

                </form>

            </div>


        </article>

    </section>

@endsection
@section('script')
    <script>
        // toast("hossein",false);
        $(document).ready(function () {
            var upload = $(".upload");
            $(upload).click(function () {
                $("#upload").trigger('click')
            })
        })
    </script>

    <script>


        CKEDITOR.replaceAll( 'desc' ,{
            versionCheck: false,
            language: 'fa',
            removeButtons: 'Image,Link,Source,About'
        });


    </script>


    <script>
        var count = 2;
        $('.btn-copy').click(function () {

            var record = '<article class="space-y-3  rounded-lg shadow-lg p-4 shadow-gray-700 p-4 transition">' +
                '<div class="flex items-center space-x-reverse space-x-8">' +
                '<h5 class="text-min font-light w-28">انتخاب محصول:</h5>' +
                '<select name="product_id[]"  class="productSelect outline-none border border-black rounded-md  select2 product-select w-48">' +
                ' ' + SelectProduct() + ' ' +
                '</select>' +
                '</div>' +
                '<div class="flex items-center space-x-reverse space-x-8">' +
                '<h5 class="text-min font-light w-28"> قیمت هر واحد(ریال) :</h5>' +
                '<input type="text" name="price[]" class="outline-none border border-black rounded-md w-48">' +
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
            select2Start()

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


                let parent=$(this).parent();
                parent[0].style.transform='scale(0)';
                setTimeout(()=>{
                    $(parent).remove();
                    changeFunction()
                    FilterSelectProduct()
                },600)

            })

        }


        function SelectProduct() {
            let html = "";
            var products =@json($products->toArray());


            $.each(products, function (index, value) {
                let title = value.title;
                if (!productSelect.includes(value.id + '')) {
                    html += "<option value='" + value.id + "' " + ((value.id) % 2 == 0 ? 'selected=selected' : '') + " >" + title.replaceAll('-', ' ') + "</option>"
                }

            })
            return html;
        }

        var products =@json($products->toArray());

        function FilterSelectProduct() {

            productSelect = [];
            var selection = $('.productSelect');

            $.each(selection, function (index, value) {

                productSelect.push($(value).val())
            })


            $.each(selection, function (index, value) {

                var select = $(value).val();
                $(value).empty()


                $.each(products, function (productsIndex, productsIndexValue) {
                    let title = productsIndexValue.title;

                    if (select === productsIndexValue.id + '') {
                        $(value).append("<option value='" + productsIndexValue.id + "' selected='selected'>" + title.replaceAll('-', ' ') + "</option>")
                    }

                    if (!productSelect.includes(productsIndexValue.id + '')) {
                        $(value).append("<option value='" + productsIndexValue.id + "'>" + title.replaceAll('-', ' ') + "</option>")

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
    <script>
        let closePage = document.querySelector('.close-page');
        let circle = document.querySelector('.circle-page');
        let plusBtn = document.querySelector('.plus');

        closePage.onclick = function () {
            circle.style.webkitClipPath = 'circle(50px at center)';
            circle.style.visibility = `hidden`;

        }
        plusBtn.onclick = function () {

            circle.style.clipPath = `circle(100% at center)`;
            circle.style.visibility = `visible`;
        }


        let fileName = document.getElementsByClassName('file-name');

        function changed(event) {
            if (event.target.files[0]) {
                fileName[0].textContent = event.target.files[0].name
            }
        }
    </script>
    <script>
        $(".append-product").click(function (event) {
            event.preventDefault();
            let serializeData = $("#product-form").serialize();
            let description = CKEDITOR.instances.product_description.getData();
            let image = document.querySelector('input[type="file"]');
            let data = new FormData();
            serializeData += `&description=${encodeURIComponent(description)}`;

            data.append('file', image.files[0]);
            data.append('content', serializeData);
            data.append('_token', "{{csrf_token()}}");
            $.ajax({
                type: 'POST',
                url: "{{route('admin.invoice.product.addProduct.ajax')}}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status && response.data && response.product) {
                        products=response.data.filter((item)=>{
                            if (item.type!="goods")
                                return item
                        })
                        let allSelectElement = document.getElementsByClassName('product-select');
                        for (const select of allSelectElement) {
                            var data = {
                                id: response.product.id,
                                text: response.product.title
                            };
                            var newOption = new Option(data.text, data.id, false, false);
                            $('.product-select').append(newOption);
                            FilterSelectProduct();

                        }
                        clear();
                        toast('محصول جدید شما اضافه شد', true);
                    }
                },
                error: function (error) {
                    if (error.responseJSON.errors) {
                        for (const value in error.responseJSON.errors) {
                            toast(error.responseJSON.errors[value][0], false);
                        }
                    }
                }
            })

        })
    </script>
    <script>

        function clear() {
            let input = document.querySelectorAll('#product-form input');
            let instance = CKEDITOR.instances['product_description'];
            instance.setData('');
            instance.updateElement();
            let fileName = document.getElementsByClassName('file-name');
            fileName[0].innerHTML = ''
            for (const child of input) {
                switch (child.getAttribute('type')) {
                    case 'text':
                    case 'file':
                        child.value = ''
                        break;

                    case 'radio':
                        child.checked = false
                        break;
                }
            }
            document.getElementsByClassName('close-page')[0].click();
        }


    </script>
@endsection
