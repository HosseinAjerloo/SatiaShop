@extends('Admin.Layout.master')
@section('header')

    <style>
        .select2-container {
            z-index: 0;
        }

        .select2-dropdown {
            z-index: 99999;
        }

        .select2-container--open {
            z-index: 99999;
        }
    </style>
@endsection
@section('content')
    <form class=" space-y-6 " action="{{route('admin.chargingTheCapsule.store')}}" method="POST" id="form">
        @csrf
        <article class="space-y-5 bg-F1F1F1 p-3 rounded-md">
            <article class="flex justify-between items-center flex-wrap">
                <div
                    class=" flex flex-wrap items-center w-full  ">
                    <div class=" flex flex-wrap items-center w-full lg:w-[70%]">
                        <h1 class="font-bold w-36 ">جستوجوی مشتری:</h1>

                        <div class="relative w-full mt-3 sm:mt-0 sm:w-[50%]">
                            <select type="text"
                                    class="select-user placeholder:text-min placeholder:text-black/50 outline-none searchInput bg-transparent w-full select2 px-10"
                                    name="name" id="input_search">
                                <option data-type="customSelect">انتخاب کنید</option>
                                @foreach($allUser as $user)
                                    <option value="{{$user->id}}" data-user_value="{{json_encode($user)}}"
                                            data-type="{{$user->customer_type}}">{{$user->fullName??'-'}}</option>
                                @endforeach
                            </select>
                            <img src=" {{asset('capsule/images/search.svg')}}" alt=""
                                 class="search cursor-pointer absolute top-[50%] right-[20px] translate-y-[-50%]">
                        </div>
                        <div class="flex items-center space-x-4 mt-4 sm:mt-0 space-x-reverse py-1.5 sm:px-2 rounded-md">
                            <div>
                                <label>حقیقی</label>
                                <input type="radio" class="person_type" name="customer_type" value="natural_person"
                                       @if(old('customer_type')=='natural_person') checked="checked" @endif>
                            </div>
                            <div>
                                <label>حقوقی</label>
                                <input class="person_type" type="radio" name="customer_type" value="juridical_person"
                                        @if(old('customer_type')=='juridical_person') checked="checked" @endif>
                            </div>
                        </div>
                    </div>


                </div>
            </article>

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

            <section class="space-y-5 w-full legal-entity-section juridical_person" style="display: none;">
                <section class="flex items-center justify-between">
                    <div class="w-[49%] flex  flex-col  space-y-2">
                        <label for="" class="flex items-center font-bold">نام سازمان/شرکت :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5 px-2"
                               name="organizationORcompanyName" value="{{old('organizationORcompanyName')}}">
                    </div>
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">شماره ثبت :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5 px-2"
                               name="registration_number" value="{{old('registration_number')}}">
                    </div>
                </section>
                <section class="flex items-center justify-between">
                    <div class="w-[49%] flex  flex-col  space-y-2">
                        <label for="" class="flex items-center font-bold">شناسه ملی :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5 px-2" name="national_id"
                               value="{{old('national_id')}}">
                    </div>
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">نام نماینده شرکت:</label>
                        <input type="text" class="border-0 w-full py-1.5 px-2" name="representative_name"
                               value="{{old('representative_name')}}">
                    </div>
                </section>
                <section class="flex items-center  justify-between">
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">کد اقتصادی :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5 px-2" name="economic_code"
                               value="{{old('economic_code')}}">
                    </div>
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">شماره تماس :</label>
                        <input type="text" class="border-0 w-full py-1.5 px-2" name="tel" value="{{old('tel')}}">
                    </div>
                </section>
            </section>
        </article>

        <article class="space-y-5 bg-F1F1F1 p-3 rounded-md">
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
                    <th class="text-[12px] sm:text-[15px] font-light px-2 leading-6 text-white w-1/12">
                        <span>حذف</span>
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
                                        @if(!str_contains($key,'_'))
                                            <img src="{{asset('capsule/images/selected.svg')}}" alt="" class="w-5">
                                        @endif
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
                                <td class="border p-2 text-center flex items-center justify-center">
                                    <img src="{{asset('capsule/images/delete.svg')}}" alt=""
                                         class="cursor-pointer mx-auto delete-row w-3 sm:w-auto"
                                         onclick="deleteRow(this)">
                                </td>
                            </tr>

                        @endforeach
                    @endisset
                @else
                    @foreach($myFavorites as $key=> $myFavorite)
                        <tr class="@if(($key%2)==0) bg-white @else bg-gray-200 @endif">
                            <td class="border border-gray-300 text-center p-1">
                                <div class="flex space-x-reverse space-x-1">
                                    <img src="{{asset('capsule/images/selected.svg')}}" alt="" class="w-5">
                                    <p class="font-semibold text-[12px] sm:text-[15px] p-1 w-full border rounded-md border-2 border-black/40">
                                        {{$myFavorite->removeUnderline??''}}
                                    </p>
                                </div>
                            </td>
                            <td class="border border-gray-400 text-center p-1">
                                <div
                                    class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-reverse sm:space-x-6">
                                    <div>
                                        <label class="text-[12px] sm:text-[15px]">استفاده شده</label>
                                        <input type="radio" name="product_status[{{$myFavorite->id}}]" value="used">
                                    </div>
                                    <div>
                                        <label class="text-[12px] sm:text-[15px]">تمدید شارژ</label>
                                        <input type="radio" name="product_status[{{$myFavorite->id}}]" value="recharge">
                                    </div>
                                </div>
                            </td>
                            <td class="border border-gray-400 text-[12px] sm:text-[15px] text-center p-1">
                                <input type="text" name="product_description[{{$myFavorite->id}}]"
                                       class="w-full border rounded-md border-2 p-1 border-black/40 outline-none px-1.5"
                                       placeholder="توضیحات">
                            </td>
                            <td class="border p-2 text-center flex items-center justify-center">
                                <img src="{{asset('capsule/images/delete.svg')}}" alt=""
                                     class="cursor-pointer mx-auto delete-row w-3 sm:w-auto" onclick="deleteRow(this)">
                            </td>
                        </tr>
                    @endforeach

                @endif


                <tr>
                    <td class="border border-gray-300 text-center p-1" rowspan="2">
                        <div class="flex items-center justify-center">
                            <p onclick="showModal()"
                               class="w-[50%] bg-sky-500 text-white py-2 rounded-md text-[12px] sm:text-[15px] border-black/40 cursor-pointer hover:bg-sky-600 transition-colors">
                                <span class="font-bold">افزودن</span>
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
                    <button onclick="printChargeCapsule(event)" type="button">جاپ رسید</button>
                </div>
            </section>


        </article>

    </form>

    <!-- Modal -->
    <div class="fixed inset-0 z-50 hidden opacity-0 transition-opacity duration-300" id="productModal"
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300"></div>

        <!-- Modal panel -->
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-right shadow-xl transition-all duration-300 sm:my-8 sm:w-full sm:max-w-3xl translate-y-4 opacity-0 scale-95"
                    id="modalContent">
                    <!-- Modal header -->
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">
                                لیست محصولات
                            </h3>
                            <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">بستن</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal body -->
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">
                                    انتخاب دسته:
                                </label>
                                <select
                                    class="w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-green-600 select2-category">
                                    <option>انتخاب کنید</option>
                                    @foreach($filterProducts as $product)
                                        @if(!str_contains($product->category->removeUnderline,'کالای مبوط'))
                                            <option
                                                data-id="{{$product->category_id}}">{{getGrandParentَAll($product)}}
                                            </option>
                                        @endif


                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">
                                    انتخاب محصول:
                                </label>
                                <select
                                    class="w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-green-600 select2-product">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}"
                                                data-categori-id="{{$product->category_id}}">{{$product->removeUnderLine}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <div class="flex items-center space-x-reverse space-x-6 mb-2">
                                    <label class="text-sm font-medium text-gray-900">وضعیت کپسول:</label>

                                    <div class="flex items-center">
                                        <input type="radio" name="capsule_status" value="used"
                                               class="h-4 w-4 border-gray-300 text-green-600 focus:ring-green-600">
                                        <label class="mr-2 text-sm text-gray-900">استفاده شده</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="capsule_status" value="recharge"
                                               class="h-4 w-4 border-gray-300 text-green-600 focus:ring-green-600">
                                        <label class="mr-2 text-sm text-gray-900">تمدید شارژ</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">
                                    توضیحات:
                                </label>
                                <textarea
                                    class="w-full description rounded-md border-0 py-2.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-green-600"
                                    rows="3" placeholder="توضیحات را وارد کنید..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" onclick="saveSelection()"
                                class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:w-auto mr-2">
                            ذخیره
                        </button>
                        <button type="button" onclick="closeModal()"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:mr-4">
                            انصراف
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function () {
            function changeCustomerType() {
                let customerType = document.querySelectorAll('input[name="customer_type"]');
                for (const customerTypeValue of customerType) {
                    if (customerTypeValue.hasAttribute('checked')) {
                        if (customerTypeValue.value == 'natural_person') {
                            document.querySelector('.natural-person-section').style.display = 'block';
                            document.querySelector('.legal-entity-section').style.display = 'none';

                        } else {
                            document.querySelector('.natural-person-section').style.display = 'none';
                            document.querySelector('.legal-entity-section').style.display = 'block';
                        }
                    }
                }
            }

            changeCustomerType();
        })

    </script>
    <script>
        $(document).ready(function () {
            // اضافه کردن event listener برای رادیو باتن‌های نوع شخص
            $('input[name="customer_type"]').on('change', function () {
                var selectedType = $(this).val();
                if (selectedType === 'natural_person') {
                    $('.natural-person-section').show();
                    $('.legal-entity-section').hide();
                    // پاک کردن تمام ورودی‌های section حقوقی
                    $('.legal-entity-section input, .legal-entity-section textarea').val('');
                } else if (selectedType === 'juridical_person') {
                    $('.natural-person-section').hide();
                    $('.legal-entity-section').show();
                    // پاک کردن تمام ورودی‌های section حقیقی
                    $('.natural-person-section input, .natural-person-section textarea').val('');
                }
            });


            // اضافه کردن event listener برای دکمه‌های پلاس و منفی موجود
            $(document).on('click', '.plus-btn', function () {
                var input = $(this).siblings('.quantity-input');
                var currentValue = parseInt(input.val()) || 0;
                input.val(currentValue + 1);
                updateProductPrice(input);
            });

            $(document).on('click', '.minus-btn', function () {
                var input = $(this).siblings('.quantity-input');
                var currentValue = parseInt(input.val()) || 0;
                if (currentValue > 1) {
                    input.val(currentValue - 1);
                    updateProductPrice(input);
                }
            });

            // اضافه کردن event listener برای تغییر مستقیم تعداد
            $(document).on('change', '.quantity-input', function () {
                updateProductPrice($(this));
            });

            // ذخیره همه گزینه‌های اصلی محصولات
            window.allProductOptions = $('.select2-product option').clone();

            // ذخیره محصولات انتخاب شده برای هر دسته‌بندی
            window.selectedProductsByCategory = {};

            $('.select2-category').select2({
                dropdownParent: $('#productModal'),
                placeholder: "انتخاب دسته",
                dir: "rtl",
                width: '100%'
            });

            $('.select2-product').select2({
                dropdownParent: $('#productModal'),
                placeholder: "انتخاب محصول",
                dir: "rtl",
                width: '100%'
            });

            // مخفی کردن همه گزینه‌های محصول به جز گزینه اول
            $('.select2-product option:not(:first)').hide();

            // غیرفعال کردن select2-product تا زمانی که دسته‌بندی انتخاب نشده است
            $('.select2-product').prop('disabled', true);
            $('.select2-product').next('.select2-container').addClass('select2-container--disabled');

            // اضافه کردن event listener برای تغییر دسته‌بندی
            $('.select2-category').on('change', function () {
                const selectedCategoryId = $(this).find(':selected').data('id');

                // ذخیره محصولات انتخاب شده برای دسته‌بندی قبلی
                const previousCategoryId = $(this).data('previous-category-id');
                if (previousCategoryId) {
                    window.selectedProductsByCategory[previousCategoryId] = $('.select2-product').val();
                }

                // ذخیره دسته‌بندی فعلی برای استفاده بعدی
                $(this).data('previous-category-id', selectedCategoryId);

                // پاک کردن همه گزینه‌های فعلی
                $('.select2-product').empty();

                // اضافه کردن گزینه پیش‌فرض
                $('.select2-product').append('<option value="">انتخاب کنید</option>');

                // اضافه کردن فقط محصولات مرتبط با دسته انتخاب شده
                window.allProductOptions.each(function () {
                    if ($(this).data('categori-id') === selectedCategoryId) {
                        $('.select2-product').append($(this).clone());
                    }
                });

                // فعال کردن select2-product
                $('.select2-product').prop('disabled', false);
                $('.select2-product').next('.select2-container').removeClass('select2-container--disabled');

                // بازسازی Select2
                $('.select2-product').select2('destroy').select2({
                    dropdownParent: $('#productModal'),
                    placeholder: "انتخاب محصول",
                    dir: "rtl",
                    width: '100%'
                });

                // بازیابی محصولات انتخاب شده قبلی برای این دسته‌بندی
                if (window.selectedProductsByCategory[selectedCategoryId]) {
                    $('.select2-product').val(window.selectedProductsByCategory[selectedCategoryId]).trigger('change');
                }
            });

            // اضافه کردن event listener برای تغییر محصول
            $('.select2-product').on('change', function () {
                const selectedOptions = $(this).find(':selected');
                const selectedProductIds = [];
                selectedOptions.each(function () {
                    selectedProductIds.push($(this).val());
                    console.log('Selected product:', $(this).text(), 'Product ID:', $(this).val());
                });
                console.log('All selected product IDs:', selectedProductIds);

                // ذخیره محصولات انتخاب شده برای دسته‌بندی فعلی
                const currentCategoryId = $('.select2-category').find(':selected').data('id');
                if (currentCategoryId) {
                    window.selectedProductsByCategory[currentCategoryId] = selectedProductIds;
                }
            });

            // اضافه کردن event listener برای آیکون‌های حذف
            $(document).on('click', '.delete-row', function () {
                $(this).closest('tr').remove();
            });
        });

        function showModal() {
            const modal = document.getElementById('productModal');
            const modalContent = document.getElementById('modalContent');

            // نمایش مودال
            modal.classList.remove('hidden');

            // تاخیر کوچک برای شروع انیمیشن
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('translate-y-4', 'opacity-0', 'scale-95');
            }, 10);

            // تنظیم مجدد Select2
            $('.select2-category').select2({
                dropdownParent: $('#productModal'),
                placeholder: "انتخاب دسته",
                dir: "rtl",
                width: '100%'
            });

            $('.select2-product').select2({
                dropdownParent: $('#productModal'),
                placeholder: "انتخاب محصول",
                dir: "rtl",
                width: '100%'
            });

            // مخفی کردن همه گزینه‌های محصول به جز گزینه اول
            $('.select2-product option:not(:first)').hide();

            // غیرفعال کردن select2-product تا زمانی که دسته‌بندی انتخاب نشده است
            $('.select2-product').prop('disabled', true);
            $('.select2-product').next('.select2-container').addClass('select2-container--disabled');
        }

        function closeModal() {
            const modal = document.getElementById('productModal');
            const modalContent = document.getElementById('modalContent');

            // شروع انیمیشن بستن
            modal.classList.add('opacity-0');
            modalContent.classList.add('translate-y-4', 'opacity-0', 'scale-95');

            // منتظر ماندن برای پایان انیمیشن
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        let count = 0;

        function saveSelection() {
            var category = $('.select2-category').val();
            var categoryText = $('.select2-category option:selected').text();
            var productId = $('.select2-product').val();
            var productText = $('.select2-product option:selected').text();
            var productPrice = parseInt($('.select2-product option:selected').data('price')) || 0;
            var capsuleStatus = $('input[name="capsule_status"]:checked').val();
            var description = $('.description').val();

            // اگر محصولی انتخاب نشده باشد، از تابع خارج می‌شویم
            if (!productId) {
                alert('لطفا یک محصول را انتخاب کنید');
                return;
            }

            // پیدا کردن جدول و ردیف دکمه حذف
            var tableBody = $('table tbody');
            var deleteButtonRow = tableBody.find('tr:last');

            // حذف ردیف دکمه حذف
            deleteButtonRow.remove();

            // تعیین کلاس رنگی برای ردیف جدید
            var rowClass = tableBody.children('tr').length % 2 === 0 ? 'bg-white' : 'bg-gray-200';

            // اضافه کردن ردیف جدید برای محصول انتخاب شده
            var newRow = `
                <tr class="${rowClass}">
                    <td class="border border-gray-300 text-center p-1">
                        <p class="font-semibold text-[12px] sm:text-[15px] p-1 w-full border rounded-md border-2 border-black/40">
                            ${productText}
                        </p>
                    </td>
                    <td class="border border-gray-400 text-center p-1">
                        <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-reverse sm:space-x-6">
                            <div>
                                <label class="text-[12px] sm:text-[15px]">استفاده شده</label>
                                <input type="radio" name="product_status[${productId}_${count}]" value="used" ${capsuleStatus === 'used' ? 'checked' : ''}>
                            </div>
                            <div>
                                <label class="text-[12px] sm:text-[15px]">تمدید شارژ</label>
                                <input type="radio" name="product_status[${productId}_${count}]" value="recharge" ${capsuleStatus === 'recharge' ? 'checked' : ''}>
                            </div>
                        </div>
                    </td>
                    <td class="border border-gray-400 text-[12px] sm:text-[15px] text-center p-1">
                        <input type="text" name="product_description[${productId}_${count}]" class="w-full border rounded-md border-2 p-1 border-black/40 outline-none px-1.5" placeholder="توضیحات" value="${description}">
                    </td>
                    <td class="border p-2 text-center flex items-center justify-center">
                        <img src="{{asset('capsule/images/delete.svg')}}" alt="" class="cursor-pointer mx-auto delete-row w-3 sm:w-auto" onclick="deleteRow(this)">
                    </td>
                </tr>
            `;

            tableBody.append(newRow);
            count++

            // اضافه کردن مجدد ردیف دکمه حذف
            var addButtonRow = `
                <tr>
                    <td class="border border-gray-300 text-center p-1" rowspan="2">
                        <div class="flex items-center justify-center">
                            <p onclick="showModal()" class="w-[50%] bg-green-500 text-white py-2 rounded-md text-[12px] sm:text-[15px] border-black/40 cursor-pointer hover:bg-green-600 transition-colors">
                                <span class="font-bold">افزودن</span>
                            </p>
                        </div>
                    </td>
                    <td class="border border-gray-400 text-center p-1" colspan="3">
                        <!-- این قسمت خالی است -->
                    </td>
                </tr>
            `;

            tableBody.append(addButtonRow);

            // به‌روزرسانی قیمت نهایی و تعداد کل
            updateTotalPrice();

            // پاک کردن اطلاعات مودال
            $('.select2-category').val('').trigger('change');
            $('.select2-product').val('').trigger('change');
            $('input[name="capsule_status"]').prop('checked', false);
            $('.description').val('');

            // پاک کردن موارد انتخاب شده در select محصولات
            $('.select2-product').empty();
            $('.select2-product').append('<option value="">انتخاب کنید</option>');

            // بازسازی Select2
            $('.select2-product').select2('destroy').select2({
                dropdownParent: $('#productModal'),
                placeholder: "انتخاب محصول",
                dir: "rtl",
                width: '100%'
            });

            // بستن مودال
            closeModal();
        }

        // تابع حذف ردیف
        function deleteRow(element) {
            $(element).closest('tr').remove();
        }

        // تابع به‌روزرسانی قیمت محصول
        function updateProductPrice(input) {
            var quantity = parseInt(input.val()) || 0;
            var price = parseInt(input.data('price')) || 0;
            var total = quantity * price;

            // به‌روزرسانی قیمت کل برای این محصول
            input.closest('tr').find('.total-price').text(total.toLocaleString());

            // به‌روزرسانی قیمت نهایی
            updateTotalPrice();
        }

        // تابع به‌روزرسانی قیمت نهایی
        function updateTotalPrice() {
            var totalPrice = 0;
            var totalQuantity = 0;

            // محاسبه مجموع قیمت‌ها و تعداد
            $('table tbody tr').each(function () {
                var quantityInput = $(this).find('.quantity-input');
                if (quantityInput.length > 0) {
                    var quantity = parseInt(quantityInput.val()) || 0;
                    var price = parseInt(quantityInput.data('price')) || 0;
                    totalPrice += quantity * price;
                    totalQuantity += quantity;
                }
            });

            // به‌روزرسانی قیمت نهایی
            $('.final-price').text(totalPrice.toLocaleString() + ' ریال');

            // به‌روزرسانی تعداد کل محصولات
            $('table tbody tr:last td:nth-child(2) p').text(totalQuantity);
        }

        // تابع جدید برای حذف محصول از جدول
        function removeProductFromTable(productName) {
            // حذف ردیف مربوط به محصول
            var productRemoved = false;
            $('table tbody tr').each(function () {
                var rowProductName = $(this).find('td:first p').text().trim();
                if (rowProductName === productName) {
                    $(this).remove();
                    productRemoved = true;
                    return false; // شکستن حلقه
                }
            });

            if (productRemoved) {
                // به‌روزرسانی قیمت نهایی و تعداد کل
                updateTotalPrice();
                // به‌روزرسانی تعداد محصولات در ردیف آخر
                var totalProducts = $('table tbody tr').length - 1; // منهای ردیف دکمه پلاس
                $('table tbody tr:last td:nth-child(2) p').text(totalProducts);
            }

            return productRemoved;
        }

        // اضافه کردن event listener برای حذف محصول از لیست انتخاب‌ها
        $('.select2-product').on('select2:unselect', function (e) {
            var productId = e.params.data.id;
            var productText = e.params.data.text;

            // حذف محصول از جدول
            removeProductFromTable(productText);
        });
    </script>
    <script>

        $(document).ready(function () {
            let userSelectBox = $('.select-user');
            if (userSelectBox.length > 0) {
                userSelectBox.change(function (e) {
                    let selectOption = $(".select-user option:selected")
                    let userType = selectOption.data('type');
                    let userInformation = selectOption.data('user_value');
                    pushValue(userType, userInformation);


                });
            } else {
                console.log('هیچ المانی با کلاس select-user پیدا نشد!');
            }
        });

        function pushValue(userType, userInformation) {
            for (const input of $(`input[name="customer_type"]`)) {
                if (input.value == userType) {
                    input.click();
                    let userInfomationElement = document.querySelector('.' + userType);
                    for (const element of userInfomationElement.children) {
                        for (const div of element.querySelectorAll('div')) {
                            for (const user in userInformation) {
                                if (div.querySelector(`input[name="${user}"]`) != null) {
                                    div.querySelector(`input[name=${user}]`).value = userInformation[user] ? value = userInformation[user] : '';
                                }
                            }
                        }
                    }
                } else {
                    if (userType == 'customSelect') {
                        // input.click();
                    }
                }
            }
        }
    </script>
    <script>
        function printChargeCapsule(e)
        {
            e.preventDefault();
            let form=document.getElementById('form');
            let myInput=document.createElement('input');
            let hasInput=document.querySelector('input[name="print"]');
            if (!hasInput)
            {
                myInput.setAttribute('type','hidden');
                myInput.setAttribute('name','print');
                myInput.setAttribute('value','print');
                form.append(myInput);
            }
            form.submit();
        }
    </script>


@endsection
