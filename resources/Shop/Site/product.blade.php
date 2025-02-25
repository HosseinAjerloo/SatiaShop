@extends('Site.Layout.master')

@section('content')

    <section class=" px-4 md:mt-3 w-full flex items-center justify-center">
        <article
            class="shadow-equalTo  w-full flex-col-reverse xl:flex-row  rounded-xl px-4 py-6 flex  items-center flex-wrap">
            <div class="w-full xl:w-3/5 border border-black p-4 rounded-md border-dashed ">
                <h1 class="text-xl text-rose-700 font-black py-1.5">عنوان:</h1>
                <div class="">
                    <p class="text-sm  font-bold lg:text-balance leading-6 bg-F2F2F2 p-4 rounded-md shadow">
                        {{$product->title}}
                    </p>
                </div>
                <div class="mt-3">
                    <h1 class="text-xl text-rose-700 font-black py-1.5 ">توضیحات:</h1>
                    <div class="text-sm lg:text-base text-justify leading-10 bg-F2F2F2 p-4 rounded-md shadow">
                        {!!$product->description!!}
                    </div>
                </div>
                <div class=" flex-col mt-3 flex   ">
                    <h1 class=" text-md text-green-600 font-bold py-1.5 px-2 flex items-center">
                        <span>قیمت:</span>
                        <span>
                            {{numberFormat($product->price)}}ریال
                        </span>
                    </h1>
                    <h1 class="text-md text-rose-700 font-bold py-1.5 flex items-center space-x-reverse space-x-1">
                        <img src="{{asset("capsule/images/box(1).svg")}}" alt="" class="w-5 h-5">
                        <span>
                            مانده درانبار:
                        </span>
                        <span>

                             @if($product->isRemaining())
                                {{$product->productRemaining()}}
                            @else
                                موجودی کافی نیست
                            @endif
                        </span>
                    </h1>
                    <h1 class="text-md text-rose-700 font-bold py-1.5 flex items-center space-x-reverse space-x-1">
                        <img src="{{asset("capsule/images/brand.png")}}" alt="" class="w-5 h-5">
                        <span>
                            برند :
                        </span>
                        <span>
                            {{$product->brand->name??""}}
                        </span>
                    </h1>

                </div>
                <button @if(!$product->isRemaining() or $product->productExistsInCart()) disabled="disabled" @endif
                class=" cursor-pointer mt-5 w-full flex items-center justify-center  @if($product->isRemaining())bg-2081F2 @else bg-rose-800 @endif   text-white py-4 rounded-md  font-bold space-x-reverse space-x-2 addCart"
                        data-id="{{$product->id}}">
                    <img src="{{asset('capsule/images/add.svg')}}" alt="" class="w-5 h-5">
                    <span class="text-lg">
                    @if($product->productExistsInCart())
                            این مورد قبلا در سبد خرید شما اضافه شده است
                        @else

                            @if($product->isRemaining())
                                اضافه کردن به سبد خرید
                            @else
                                موجودی کافی نیست
                            @endif
                        @endif


                    </span>
                </button>

            </div>
            <div class="w-full lg:w-[39%] flex items-center justify-center ">
                <img src="{{asset($product->image->path??'')}}" alt="" class="w-96 h-96 object-contain">
            </div>

        </article>


    </section>

@endsection

@section('script')
    <script>

        $(document).ready(function () {


            let addCart = $(".addCart");
            $(addCart).click(function () {

                let productId = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('panel.cart.addCart')}}",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        product_id: productId
                    },
                    success: function (response) {

                        toast(response.message, response.status)

                        if (response.status) {
                            $(addCart).attr('disabled', 'disabled');
                            $(addCart).children('span').html('به سبد خریدشما اضافه شد');
                        }

                    },
                    error: function (error) {

                        console.log('error')
                    }
                });
            })
        })
    </script>
    <script>
        function toast(message, status) {
            alert(message)
            showToast(message);
            if (!status) {
                $(".progress-bar div").css({'background-color': 'red'})
            }

        }
    </script>
@endsection
