@extends('Admin.Layout.master')

@section('content')


    <form class="flex items-center justify-between space-x-reverse space-x-3 px-2 mt-5">
        <a href="#" class="flex items-center space-x-reverse px-2">

            <h1 class="text-min font-bold">تنظیمات نرم افزار</h1>
        </a>

    </form>
    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2 py-3 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نام برنامه
                </h1>
            </div>


        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            <div class="p-2   flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                <a href="{{route('admin.setting.edit',$setting->id)}}" class="w-1/5">
                    <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center underline underline-offset-4 text-sky-500">
                        {{$setting->name??''}}
                    </p>
                </a>

            </div>


        </article>
    </section>

@endsection
