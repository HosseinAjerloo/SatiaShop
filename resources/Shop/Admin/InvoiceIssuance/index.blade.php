@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-3 relative">
        <article class="space-y-5 bg-F1F1F1 p-6 rounded-md">

            <article class="flex justify-between items-center">
                <div class="flex items-center space-x-reverse space-x-2 w-1/2">
                    <img src="{{asset("capsule/images/blue-user.svg")}}" alt="">
                    <div class="flex items-center space-x-2 space-x-reverse">
                        <h1 class="font-bold text-sm sm:tetx-base">نام مشتری:</h1>
                        <span class="text-sm sm:tetx-base">حسین آجرلو</span>
                    </div>

                </div>
                <div class="flex items-center justify-end space-x-reverse  space-x-2 w-1/2">
                    <h1 class="font-bold text-sm sm:tetx-base">تاریخ:</h1>
                    <span class="text-sm sm:tetx-base">1403/12/20</span>
                </div>
            </article>
        </article>
        <article class="space-y-5 bg-F1F1F1 p-6 rounded-md ">
            <article class="flex justify-between items-center">
                <div class="flex items-center space-x-reverse space-x-2">
                    <img src="{{asset("capsule/images/plus.svg")}}" alt="" class="plus cursor-pointer">
                    <h1 class="font-medium w-44">اقلام فاکتور</h1>
                </div>
                <div class="flex items-center space-x-reverse space-x-2">
                    <h1 class="font-bold text-sm sm:tetx-base">شماره فاکتور:</h1>
                    <span class="text-sm sm:tetx-base">12587</span>
                </div>
            </article>
            <form action="{{route('hossein.back')}}" method="post" class="w-full">
                @csrf

                <table class="border-collapse   border border-gray-400 w-full table-fixed">
                    <thead class="bg-2081F2 ">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                            <span>سفارش</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                            <span class="text-min sm:text-sm text-nowrap">قیمت کل</span>
                            <span class="text-[11px]">(ریال)</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                            <span class="text-min sm:text-sm text-nowrap">عملیات</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                            <span class="text-min sm:text-sm text-nowrap">چاپ فاکتور</span>
                        </th>

                    </tr>

                    </thead>
                    <tbody>
                    @foreach($reside->resideItem()->where('status','recharge')->get() as $key=> $resideItem)
                        <tr class="@if($key%2==0) bg-white @else bg-gray-200/70 @endif">

                            <td class="border border-gray-400  text-center  p-1">
                                <p class="font-bold text-rose-600 sm:text-[15px] text-[10px] p-1 w-full ">
                                    {{$resideItem->product->removeUnderline??''}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="font-bold  sm:text-[15px] text-[10px] p-1 w-full ">
                                    3،250،000
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <div class="w-full flex items-center justify-center">
                                    <img src="{{asset('capsule/images/plus.svg')}}" alt="" class="w-[30px]">

                                </div>
                            </td>
                            <td class="border border-gray-300/75 flex items-center justify-center  text-center">
                                <canvas class="max-w-min mx-auto p-3 qrcode"></canvas>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
                <section class="flex items-center justify-center space-x-reverse space-x-3 p-5">
                    <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button>صدور فاکتورنهایی</button>
                    </div>
                    <div class="bg-2081F2 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button>صدور و پرینت</button>
                    </div>
                </section>
            </form>


        </article>

    </section>

@endsection
@section('script')
        <script>
            function generateQrCode(){
                let qrCodeElement = document.querySelectorAll('.qrcode');
                let count=0;
                let color='';
                for (const imgQr of qrCodeElement)
                {
                    if(count%2===0){
                        color='#ffffff';
                    }else {
                        color='#e5e7eb';
                    }
                    count+=1;
                    QRCode.toCanvas(imgQr,'hossein Ajerloo', {
                        width: 78,
                        color: {
                            dark: '#000000',
                            light: color
                        }
                    });

                }
            }
            generateQrCode();
        </script>
@endsection
