<section class="space-y-5">
    <div>
        <h1 class="text-rose-600  font-black">{{$resideItem->product->removeUnderline}}</h1>
    </div>
    <article class=" w-full flex flex-col justify-center md:w-3/4 lg:w-3/5 xl:w-2/5 space-y-4">
        <div
            class=" flex justify-center items-start flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
            <label class="font-semibold text-sm">حجم گاز (برحسب ظرفیت کپسول ) :</label>
            <select class="select2 w-full sm:w-1/2">
                @foreach($categories::where('id',7)->first()->productes as $products)
                    <option value="">{{$products->removeUnderLine}}</option>

                @endforeach

            </select>
        </div>
        <div
            class=" flex justify-center items-start flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
            <label class="font-semibold text-sm">شیر دسته کامل :</label>
            <select class="select2 w-full sm:w-1/2">
                <option value="">خیر</option>

                <option value="{{$categories::where('id',3)->first()->productes()->where('id','54')->first()->id}}">بله</option>


            </select>
        </div>
        <div
            class=" flex justify-center items-start flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
            <label class="font-semibold text-sm">شیپوری :</label>
            <select class="select2 w-full sm:w-1/2 ">
                <option value="">1 کیلویی</option>
                <option value="">2 کیلویی</option>
                <option value="">3 کیلویی</option>
            </select>
        </div>

        <div
            class=" flex justify-center items-start flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
            <label class="font-semibold text-sm">اجرت (ریال) :</label>
            <input type="number"
                   class="w-full sm:w-1/2 outline-none p-[2.5px] text-center border-black/50 border rounded-[5px]">
        </div>
    </article>
    <article class="flex items-center space-x-reverse space-x-4">
        <button class="px-6 py-1 bg-268832 text-white rounded-md">ذخیره</button>
        <a href="" class="px-6 py-1 bg-FF3100 text-white rounded-md">بازگشت</a>
    </article>
</section>
