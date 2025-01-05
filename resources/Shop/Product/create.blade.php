<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
{{--@dd($errors)--}}
<button class="btn-copy">copy</button>
<form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data" class="main">
    @csrf
    <div>
        <h1>
            تاممین کنندگان
        </h1>
        <select name="supplier_id">
            @foreach($suppliers as $supplier)
                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
            @endforeach
        </select>
        <br>
        <h1>
            توضیحات مربوط به فاکتور
        </h1>
        <textarea name="invoiceDescription"></textarea>
    </div>
    <hr>
    <br>
    <div class="parrent">
        <div id="copy">
            <hr>

            <h1>قیکت هر واحد</h1>
            <input type="text" placeholder="price" name="price[]" value="{{old('price')}}">
            <br>
            <h1>انتخاب محصول</h1>
            <select name="product_id[]">
                @foreach($products as $product)
                    <option value="{{$product->id}}">{{$product->title}}</option>
                @endforeach
            </select>
            <br>
            <h1>توضیحات</h1>
            <textarea name="description[]"></textarea>
            <br>
            <h1>تعداد</h1>
            <input type="number" name="amount[]">
            <br>
            <hr>

        </div>

    </div>
    <button>send</button>
</form>
<br><br><br><br>
<h1>محصول</h1>
<br><br>

<div>
    title
    <input type="text" placeholder="name" name="title" value="{{old('title')}}" id="title">
    <br>

    قیمت کالا
    <input type="text" placeholder="price" name="price" value="{{old('price')}}" id="productprice">
    <br>

    دسته بندی
    <select name="category_id" id="productCategory">

        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach

    </select>
    <br>

    توضیحات
    <textarea name="description" id="productdescription">

    </textarea>

    <br>
    عکس
    <input type="file" name="file" id="productfile">
    <br>

    {{--    active--}}
    {{--    <input type="radio" name="status" id="" value="active"--}}
    {{--           @if(old('active')=='active') checked="checked" @endif >--}}
    {{--    <br>--}}
    {{--    inactive--}}
    {{--    <input type="radio" name="status" id="" value="inactive"--}}
    {{--           @if(old('active')=='inactive') checked="checked" @endif>--}}
    {{--    <br>--}}

    <button class="addproduct">اضافه کردن محصول</button>
</div>

<script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {

        $('.addproduct').click(function () {
            var title = $("#title").val();
            var productprice = $("#productprice").val();
            var productCategory = $("#productCategory").val();
            var productdescription = $("#productdescription").val();
            var productfile = $("#productfile").val();


            $.ajax({
                url: "{{route('test')}}",
                type: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                    category_id: productCategory,
                    title: title,
                    price: productprice,
                    description: productdescription

                },
                // processData: false,
                // contentType: false,
                success: function (result) {
                    if (result.data) {
                        console.log(result.data)
                    }
                }
            });
        })


        $('.btn-copy').click(function () {
            var copyElement = $('#copy').clone(false);
            console.log(copyElement);
            $('.parrent').append("<br>");
            $('.parrent').append(copyElement);
        })
    })
</script>
</body>
</html>
