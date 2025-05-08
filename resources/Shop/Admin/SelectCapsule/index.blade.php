@extends('Admin.Layout.master')
@section('content')

    <section class=" space-y-3 relative w-4/5 mx-auto">
        <article class="space-y-5 bg-F1F1F1 p-6 rounded-md">

            <article class="flex justify-between items-center">
                <div class="flex items-center space-x-reverse space-x-2 w-1/2">
                    <img src="{{asset("capsule/images/blue-user.svg")}}" alt="">
                    <div class="flex items-center space-x-2 space-x-reverse">
                        <h1 class="font-bold text-sm sm:tetx-base">نام مشتری:</h1>
                        <span class="text-sm sm:tetx-base">{{$reside->user->fullName}}</span>
                    </div>

                </div>
                <div class="flex items-center justify-end space-x-reverse  space-x-2 w-1/2">
                    <h1 class="font-bold text-sm sm:tetx-base">تاریخ:</h1>
                    <span
                        class="text-sm sm:tetx-base">{{\Morilog\Jalali\Jalalian::forge($reside->created_at)->format('Y/m/d')}}</span>
                </div>
            </article>
        </article>
        <article class="space-y-5 bg-F1F1F1 p-6 rounded-md ">

            <form action="{{route('admin.invoice.issuance.store',[$reside,$resideItem])}}" method="post" class="w-full">
                @csrf
                @if( isset($resideItem->product->relatedGoods->id))
                    <section class="space-y-5">
                        <div>
                            <h1 class="text-rose-600  font-black">{{$resideItem->product->removeUnderline}}</h1>
                        </div>
                        <article class=" w-full flex flex-col justify-center md:w-3/4 lg:w-3/5 xl:w-2/5 space-y-4">
                            @foreach($categories::where('category_id',$resideItem->product->relatedGoods->id)->get() as $childCategory)
                                <div
                                    class=" flex justify-center items-start flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                    <label class="font-semibold text-sm">{{$childCategory->removeUnderline}} :</label>
                                    <select class="select2 w-full sm:w-1/2" name="product_id[]">
                                        <option value="">انتخاب کنید</option>
                                        @foreach($childCategory->productes as $product)
                                            <option value="{{$product->id}}">{{$product->removeUnderLine}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach

                            @foreach($resideItem->product->relatedGoods->productes as $product)
                                <div
                                    class=" flex justify-center items-start flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                    <label class="font-semibold text-sm">{{$product->removeUnderline}} :</label>
                                    <select class="select2 w-full sm:w-1/2" name="product_id[]">
                                        <option value="{{$product->id}}">بله</option>
                                        <option value="">خیر</option>
                                    </select>
                                </div>
                            @endforeach
                            <div
                                class=" flex justify-center items-start flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                <label class="font-semibold text-sm">بالن :</label>
                                <select class="select2 w-full sm:w-1/2" name="balloons">
                                    <option value="">انتخاب کنید</option>
                                    <option value="internal">داخلی</option>
                                    <option value="external">خارجی</option>
                                </select>
                            </div>
                            <div
                                class=" flex justify-center items-start flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                <label class="font-semibold text-sm">اجرت (ریال) :</label>
                                <input type="number"
                                       class="w-full sm:w-1/2 outline-none p-[2.5px] text-center border-black/50 border rounded-[5px]"
                                       name="salary">
                            </div>
                        </article>
                        <article class="flex items-center space-x-reverse space-x-4">
                            <button class="px-6 py-1 bg-268832 text-white rounded-md">ذخیره</button>
                            <a href="{{route('admin.invoice.issuance.index',$reside)}}"
                               class="px-6 py-1 bg-FF3100 text-white rounded-md">بازگشت</a>
                        </article>
                    </section>
                @endif


            </form>


        </article>

    </section>

@endsection
@section('script')
    <script>
        function generateQrCode() {
            let qrCodeElement = document.querySelectorAll('.qrcode');
            let count = 0;
            let color = '';
            for (const imgQr of qrCodeElement) {
                if (count % 2 === 0) {
                    color = '#ffffff';
                } else {
                    color = '#e5e7eb';
                }
                count += 1;
                QRCode.toCanvas(imgQr, 'hossein Ajerloo', {
                    width: 50,
                    color: {
                        dark: '#000000',
                        light: color
                    }
                });

            }
        }

        generateQrCode();
    </script>

    <script>
        CKEDITOR.replace('description', {
            versionCheck: false,
            language: 'fa',
            removeButtons: 'Image,Link,Source,About'
        });
    </script>
@endsection
