@extends('Admin.Layout.master')

@section('content')

    <article class="space-y-5 bg-F1F1F1 p-3 rounded-md">
        <section class="space-y-5 w-full natural-person-section natural_person">


            <section class="flex items-center justify-between">
                <div class="w-[49%] flex  flex-col  space-y-2">
                    <label for="" class="flex items-center font-bold">نام :</label>
                    <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5 px-2" name="name"
                           value="{{old('name')}}">
                </div>
                <div class="w-[49%] flex  flex-col space-y-2">
                    <label for="" class="flex items-center font-bold">نام خانوادگی :</label>
                    <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5 px-2" name="family"
                           value="{{old('family')}}">
                </div>
            </section>
            <section class="flex items-center justify-between">
                <div class="w-[49%] flex  flex-col  space-y-2">
                    <label for="" class="flex items-center font-bold">کدملی :</label>
                    <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5 px-2" name="national_code"
                           value="{{old('national_code')}}">
                </div>
                <div class="w-[49%] flex  flex-col space-y-2">
                    <label for="" class="flex items-center font-bold">تلفن همراه :</label>
                    <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5 px-2" name="mobile"
                           value="{{old('mobile')}}">
                </div>
            </section>
            <section class="flex items-center ">
                <div class="w-full flex  flex-col space-y-2">
                    <label for="" class="flex items-center font-bold">آدرس :</label>
                    <input type="text" class="border-0 w-full rounded-[5px] shadow py-4 px-2 " name="address"
                           value="{{old('address')}}">
                </div>
            </section>

        </section>
        <section class="flex items-center justify-center space-x-reverse space-x-3 p-5">
            <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                <button>ویرایش و ثبت اطلاعات</button>
            </div>

        </section>
    </article>


@endsection
