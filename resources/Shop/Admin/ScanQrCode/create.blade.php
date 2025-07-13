@extends('Admin.Layout.master')

@section('content')
    <section class="space-y-5">
        <article class="p-4 flex flex-wrap space-y-6 bg-F1F1F1 rounded-md">
            <div class="flex flex-wrap justify-between items-center w-full space-y-4 sm:space-y-0">
                <div class="flex  items-center  space-x-reverse space-x-2 w-full sm:w-1/4">
                    <img src="{{asset('capsule/images/blueUserIcon.svg')}}" alt="" class="w-6">
                    <h2 class="font-bold ">نام مشتری</h2>
                    <p class="font-thin">{{$resideItemHistory->first()->reside->user->fullName??''}}</p>
                </div>
                <div class="flex  items-center justify-center space-x-reverse space-x-2 w-full sm:w-1/4">
                    <h2 class="font-bold "> کدملی</h2>
                    <p class="font-thin">{{$resideItemHistory->first()->reside->user->national_code??''}}</p>
                </div>
                <div class="flex  items-center justify-center space-x-reverse space-x-2 w-full sm:w-1/4">

                    <h2 class="font-bold ">نوع کپسول</h2>
                    <p class="font-thin">{{$resideItemHistory->first()->product->removeUnderLine??''}}</p>
                </div>

                <div class="flex  items-center space-x-reverse justify-center space-x-2 w-full sm:w-1/4">
                    <h2 class="font-bold ">تلفن همراه:</h2>
                    <p class="font-thin">{{$resideItemHistory->first()->reside->user->mobile??''}}</p>
                </div>
            </div>

            <div class="flex flex-wrap justify-between items-center w-full">
                <div class="flex justify-between items-center space-x-reverse space-x-2">
                    <h2 class="font-bold ">آدرس</h2>
                    <p class="font-thin">{{$resideItemHistory->first()->reside->user->address??''}}15</p>
                </div>
            </div>
        </article>
        <form class=" bg-F1F1F1 p-3 rounded-md" action="{{route('admin.scanQrCode.store',$residItem->unique_code)}}" method="POST">
        @csrf


            <article class="flex justify-between items-center">
                <h1 class="font-bold w-44">اقلام سفارش:</h1>

            </article>

            <table class="border-collapse border border-gray-400 w-full">
                <thead class="bg-2081F2">
                <tr>
                    <th class="text-[12px] sm:text-[15px] font-light px-2 leading-6 text-white w-1/4">
                        <span>نوع سفارش</span>
                    </th>
                    <th class="text-[12px] sm:text-[15px] font-light px-2 leading-6 text-white w-1/3">
                        <span class="font-thin">وضعیت کپسول</span>
                    </th>
                    <th class="text-[12px] sm:text-[15px] font-light px-2 leading-6 text-white w-1/4">
                        <span>توضیحات</span>
                    </th>

                </tr>
                </thead>
                <tbody>
                @if($errors->any())
                    @php
                        $count=1;
                    @endphp
                    @isset(old()['product_description'])
                        @foreach(old('product_description') as $key=> $value)

                            @php
                                $count++;
                                    if (str_contains($key,'_'))
                                        {
                                            $id= explode('_',$key)[0];
                                        }
                                    else{
                                        $id=$key;
                                    }
                                    $product=\App\Models\Product::find($id);
                            @endphp
                            <tr class="@if(($count%2)==0) bg-white @else bg-gray-200 @endif">

                                <td class="border border-gray-300 text-center p-1">
                                    <div class="flex space-x-reverse space-x-1">

                                        <p class="font-semibold text-[12px] sm:text-[15px] p-1 w-full border rounded-md border-2 border-black/40">
                                            {{$product->removeUnderline??''}}
                                        </p>
                                    </div>
                                </td>

                                <td class="border border-gray-400 text-center p-1">
                                    <div
                                        class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-reverse sm:space-x-6">
                                        <div>
                                            <label class="text-[12px] sm:text-[15px]">استفاده شده</label>
                                            <input type="radio" name="product_status[{{$key}}]" value="used"
                                                   @if(isset(old('product_status')[$key]) and old('product_status')[$key]=='used') checked @endif>
                                        </div>
                                        <div>
                                            <label class="text-[12px] sm:text-[15px]">تمدید شارژ</label>
                                            <input type="radio" name="product_status[{{$key}}]" value="recharge"
                                                   @if(isset(old('product_status')[$key]) and old('product_status')[$key]=='recharge') checked @endif>
                                        </div>
                                    </div>
                                </td>
                                <td class="border border-gray-400 text-[12px] sm:text-[15px] text-center p-1">
                                    <input type="text" name="product_description[{{$key}}]"
                                           class="w-full border rounded-md border-2 p-1 border-black/40 outline-none px-1.5"
                                           placeholder="توضیحات"
                                           value="{{isset(old('product_description')[$key])? old('product_description')[$key]:''}}">
                                </td>

                            </tr>

                        @endforeach
                    @endisset
                @else
                    <tr class="bg-white ">
                        <td class="border border-gray-300 text-center p-1">
                            <div class="flex space-x-reverse space-x-1">
                                <p class="font-semibold text-[12px] sm:text-[15px] p-1 w-full border rounded-md border-2 border-black/40">
                                    {{$residItem->product->removeUnderline??''}}
                                </p>
                            </div>
                        </td>
                        <td class="border border-gray-400 text-center p-1">
                            <div
                                class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-reverse sm:space-x-6">
                                <div>
                                    <label class="text-[12px] sm:text-[15px]">استفاده شده</label>
                                    <input type="radio" name="product_status[{{$residItem->product->id}}]" value="used">
                                </div>
                                <div>
                                    <label class="text-[12px] sm:text-[15px]">تمدید شارژ</label>
                                    <input type="radio" name="product_status[{{$residItem->product->id}}]" value="recharge">
                                </div>
                            </div>
                        </td>
                        <td class="border border-gray-400 text-[12px] sm:text-[15px] text-center p-1">
                            <input type="text" name="product_description[{{$residItem->product->id}}]"
                                   class="w-full border rounded-md border-2 p-1 border-black/40 outline-none px-1.5"
                                   placeholder="توضیحات">

                        </td>

                    </tr>

                @endif


                <tr>
                    <td class="border border-gray-300 text-center p-1" rowspan="2">
                        <div class="flex items-center justify-center">
                            <p onclick="showModal()"
                               class="w-[50%] bg-sky-500 text-white py-2 rounded-md text-[12px] sm:text-[15px] border-black/40 cursor-pointer hover:bg-sky-600 transition-colors">
                                <span class="font-bold">اسکن Qrcode</span>
                            </p>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <section class="flex items-center justify-center space-x-reverse space-x-3 p-5">
                <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                    <button>ثبت رسید</button>
                </div>
                <div class="bg-FFB01B px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                    <button onclick="printChargeCapsule(event)" type="button">چاپ رسید</button>
                </div>
            </section>


        </form>

    </section>

@endsection

