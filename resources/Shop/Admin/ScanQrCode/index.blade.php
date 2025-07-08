
@extends('Admin.Layout.master')

@section('content')


    <section class="px-2 mt-5 ">
        <article class="p-4 flex flex-wrap space-y-6 bg-F1F1F1 rounded-md">
            <div class="flex justify-between items-center w-full">
                <div class="flex justify-between items-center space-x-reverse space-x-2">
                    <img src="{{asset('capsule/images/blueUserIcon.svg')}}" alt="">
                    <h2 class="font-bold ">نام مشتری</h2>
                    <p class="font-thin">حسین آجرلو</p>
                </div>
                <div class="flex justify-between items-center space-x-reverse space-x-2">

                    <h2 class="font-bold ">نوع کپسول</h2>
                    <p class="font-thin">پودروگاز</p>
                </div>

                <div class="flex justify-between items-center space-x-reverse space-x-2">
                    <h2 class="font-bold ">تلفن همراه:</h2>
                    <p class="font-thin">09186414452</p>
                </div>
            </div>

            <div class="flex justify-between items-center w-full ">
                <div class="flex  items-center space-x-reverse space-x-2 w-1/2">
                    <h2 class="font-bold ">آدرس</h2>
                    <p class="font-thin bg-rose-500 leading-8">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                </div>
               <div class="flex justify-between  items-center space-x-reverse space-x-2 w-1/2 bg-blue-400">
                   <div class="flex justify-between items-center space-x-reverse space-x-2">

                       <h2 class="font-bold ">نوع کپسول</h2>
                       <p class="font-thin">پودروگاز</p>
                   </div>

                   <div class="flex justify-between items-center space-x-reverse space-x-2">
                       <h2 class="font-bold ">تلفن همراه:</h2>
                       <p class="font-thin">09186414452</p>
                   </div>
               </div>
            </div>

        </article>
    </section>


@endsection

