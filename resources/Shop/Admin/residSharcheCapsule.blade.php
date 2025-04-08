@extends('Admin.Layout.master')

@section('content')

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

    <form class=" space-y-6 " action="{{route('hossein.back')}}" method="POST">
        @csrf

        <article class="space-y-5 bg-F1F1F1 p-3">
            <article class="flex justify-between items-center flex-wrap">
                <div
                    class=" flex flex-wrap items-center w-full  ">
                    <div class=" flex flex-wrap items-center w-full lg:w-[70%]">
                             <h1 class="font-bold w-36 ">جستوجوی مشتری:</h1>

                            <div class="relative w-full mt-3 sm:mt-0 sm:w-[50%]" >
                    <select type="text"
                                        class="placeholder:text-min placeholder:text-black/50 outline-none searchInput bg-transparent w-full select2 px-10"
                            name="name" id="input_search">
                        <option>hossein</option>
                    </select>
                                <img src=" {{asset('capsule/images/search.svg')}}" alt=""
                                     class="search cursor-pointer absolute top-[50%] right-[20px] translate-y-[-50%]">
                            </div>
                            <div class="flex items-center space-x-4 mt-4 sm:mt-0 space-x-reverse py-1.5 sm:px-2 rounded-md">
                                <div>
                                    <label>حقیقی</label>
                                    <input type="radio">
                                </div>
                                <div>
                                    <label>حقوقی</label>
                                    <input type="radio">
                                </div>
                            </div>
                    </div>


                   <div class="w-full lg:w-[20%]  mt-3 lg:mt-0 flex items-center md:justify-end">

                       <div
                           class="flex items-center  space-x-1 space-x-reverse  rounded-md text-min">
                           <h5 class="font-bold">شماره رسید</h5>
                           <span>10001</span>
                       </div>
                   </div>
                </div>
            </article>

            <section class="space-y-5 w-full ">
                <section class="flex items-center justify-between">
                    <div class="w-[49%] flex  flex-col  space-y-2">
                        <label for="" class="flex items-center font-bold">نام :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5">
                    </div>
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">نام خانوادگی :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5">
                    </div>
                </section>
                <section class="flex items-center justify-between">
                    <div class="w-[49%] flex  flex-col  space-y-2">
                        <label for="" class="flex items-center font-bold">کدملی :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5">
                    </div>
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">تلفن همراه :</label>
                        <input type="text " class="border-0 w-full rounded-[5px] shadow py-1.5">
                    </div>
                </section>
                <section class="flex items-center ">

                    <div class="w-full flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">آدرس :</label>
                        <input type="text " class="border-0 w-full rounded-[5px] shadow py-4 px-2">
                    </div>
                </section>

            </section>



            <section class="space-y-5 w-full ">
                <section class="flex items-center justify-between">
                    <div class="w-[49%] flex  flex-col  space-y-2">
                        <label for="" class="flex items-center font-bold">نام سازمان/شرکت  :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5">
                    </div>
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">شماره ثبت :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5">
                    </div>
                </section>
                <section class="flex items-center justify-between">
                    <div class="w-[49%] flex  flex-col  space-y-2">
                        <label for="" class="flex items-center font-bold">شناسه ملی  :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5">
                    </div>
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">نام نماینده شرکت:</label>
                        <input type="text " class="border-0 w-full py-1.5">
                    </div>
                </section>
                <section class="flex items-center  justify-between">

                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">کد اقتصادی :</label>
                        <input type="text " class="border-0 w-full rounded-[5px] shadow py-1.5">
                    </div>
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">شماره تماس :</label>
                        <input type="text " class="border-0 w-full py-1.5">
                    </div>
                </section>


            </section>
        </article>

        <article class="space-y-5 bg-F1F1F1 p-3 ">
            <article class="flex justify-between items-center">
                <h1 class="font-bold w-44">اقلام سفارش:</h1>

            </article>

                <table class="border-collapse  border border-gray-400 w-full table-fixed">
                    <thead class="bg-2081F2">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>نوع سفارش</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                        <span>وضعیت کپسول</span>
                        </th>

                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>توضیحات</span>
                        </th>
                    </tr>

                    </thead>
                    <tbody>
                    <tr>
                        <td class="border border-gray-300  text-center p-1 ">
                        <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40 ">
                            شارژ کپسول 250 گرمی
                        </p>
                        </td>
                        <td class="border border-gray-400  text-center p-1">
                        <div class=" flex items-center justify-center space-x-reverse space-x-6">
                            <div>
                                <label>استفاده شده</label>
                                <input type="radio" name="product[1]" value="yes">
                            </div>
                            <div>
                                <label>تمدید شارژ</label>
                                <input type="radio" name="product[1]" value="no">
                            </div>
                            </div>

                        </td>


                        <td class="border border-gray-400 text-[11.5px]  text-center p-1">
                        <input type="text"
                               class="w-full border rounded-md border-2 p-1 border-black/40 outline-none px-1.5"
                               placeholder="توضیحات">
                        </td>

                    </tr>
                    <tr>
                        <td class="border border-gray-300  text-center p-1 ">
                        <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40 ">
                            شارژ کپسول 250 گرمی
                        </p>
                        </td>
                        <td class="border border-gray-400  text-center p-1">
                        <div class=" flex items-center justify-center space-x-reverse space-x-6">
                            <div>
                                <label>استفاده شده</label>
                                <input type="radio" name="product[2]" value="yes">
                            </div>
                            <div>
                                <label>تمدید شارژ</label>
                                <input type="radio" name="product[2]" value="no">
                            </div>
                            </div>

                        </td>


                        <td class="border border-gray-400 text-[11.5px]  text-center p-1">
                        <input type="text"
                               class="w-full border rounded-md border-2 p-1 border-black/40 outline-none px-1.5"
                               placeholder="توضیحات">
                        </td>

                    </tr>
                    <tr>
                        <td class="border border-gray-300  text-center p-1 ">
                        <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40 ">
                            شارژ کپسول 250 گرمی
                        </p>
                        </td>
                        <td class="border border-gray-400  text-center p-1">
                        <div class=" flex items-center justify-center space-x-reverse space-x-6">
                            <div>
                                <label>استفاده شده</label>
                                <input type="radio" name="product[3]" value="yes">
                            </div>
                            <div>
                                <label>تمدید شارژ</label>
                                <input type="radio" name="product[3]" value="no">
                            </div>
                            </div>

                        </td>


                        <td class="border border-gray-400 text-[11.5px]  text-center p-1">
                        <input type="text"
                               class="w-full border rounded-md border-2 p-1 border-black/40 outline-none px-1.5"
                               placeholder="توضیحات">
                        </td>
                    </tr>


                <tr>
                    <td class="border border-gray-300  text-center p-1 " rowspan="2">
                        <div class="flex items-center justify-center ">
                            <p onclick="showModal()" class="w-[50%] bg-sky-500 text-white py-2 rounded-md sm:font-normal sm:text-sm text-[10px] border-black/40 cursor-pointer hover:bg-sky-600 transition-colors">
                                <span class="font-bold">افزودن محصول</span>
                            </p>
                        </div>
                        </td>

                    </tr>





                    </tbody>
                </table>
                <section class="flex items-center justify-center space-x-reverse space-x-3 p-5">
                    <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button>صدور فاکتور</button>
                    </div>
                    <div class="bg-2081F2 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button>چاپ برگه کپسول</button>
                    </div>
                    <div class="bg-FFB01B px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button>جاپ رسید</button>
                    </div>
                </section>


        </article>

    </form>

    <!-- Modal -->
    <div class="fixed inset-0 z-50 hidden opacity-0 transition-opacity duration-300" id="productModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300"></div>

        <!-- Modal panel -->
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-right shadow-xl transition-all duration-300 sm:my-8 sm:w-full sm:max-w-3xl translate-y-4 opacity-0 scale-95" id="modalContent">
                    <!-- Modal header -->
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">
                                لیست محصولات
                            </h3>
                            <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">بستن</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
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
                                <select class="w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-green-600 select2-category">
                                    <option>انتخاب کنید</option>
                                    <option data-id="1">دسته یک</option>
                                    <option data-id="2">دسته دوم</option>
                                    <option data-id="3">دسته سوم</option>
                                    <option data-id="4">دسته چهارم</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">
                                    انتخاب محصول:
                                </label>
                                <select class="w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-green-600 select2-product" multiple>
                                    <option value="">انتخاب کنید</option>
                                    <option value="1" data-categori-id="1" data-price="1000000">محصول 1</option>
                                    <option value="2" data-categori-id="1" data-price="2000000">محصول 2</option>
                                    <option value="3" data-categori-id="2" data-price="3000000">محصول 3</option>
                                    <option value="4" data-categori-id="2" data-price="4000000">محصول 4</option>
                                    <option value="5" data-categori-id="3" data-price="5000000">محصول 5</option>
                                    <option value="6" data-categori-id="3" data-price="6000000">محصول 6</option>
                                    <option value="7" data-categori-id="4" data-price="7000000">محصول 7</option>
                                    <option value="8" data-categori-id="4" data-price="8000000">محصول 8</option>
                                </select>
                            </div>
                            <div>
                                <div class="flex items-center space-x-reverse space-x-6 mb-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="capsule_status" value="used" class="h-4 w-4 border-gray-300 text-green-600 focus:ring-green-600">
                                        <label class="mr-2 text-sm text-gray-900">استفاده شده</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="capsule_status" value="recharge" class="h-4 w-4 border-gray-300 text-green-600 focus:ring-green-600">
                                        <label class="mr-2 text-sm text-gray-900">تمدید شارژ</label>
                                    </div>
                                    <label class="text-sm font-medium text-gray-900">وضعیت کپسول:</label>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">
                                    توضیحات:
                                </label>
                                <textarea class="w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-green-600" rows="3" placeholder="توضیحات را وارد کنید..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" onclick="saveSelection()" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:w-auto">
                            ذخیره
                        </button>
                        <button type="button" onclick="closeModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:mr-4">
                            انصراف
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
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
                width: '100%',
                multiple: true
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
                    width: '100%',
                    multiple: true
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
                width: '100%',
                multiple: true
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

        function saveSelection() {
            var category = $('.select2-category').val();
            var categoryText = $('.select2-category option:selected').text();
            var products = $('.select2-product').val();
            var productTexts = [];
            var productPrices = [];
            var totalPrice = 0;
            var capsuleStatus = $('input[name="capsule_status"]:checked').val();
            var description = $('textarea').val();

            // اگر محصولی انتخاب نشده باشد، از تابع خارج می‌شویم
            if (!products || products.length === 0) {
                alert('لطفا حداقل یک محصول را انتخاب کنید');
                return;
            }

            // دریافت متن و قیمت محصولات انتخاب شده
            products.forEach(function(productId) {
                var productOption = $('.select2-product option[value="' + productId + '"]');
                var productText = productOption.text();
                var productPrice = parseInt(productOption.data('price'));
                
                productTexts.push(productText);
                productPrices.push(productPrice);
                totalPrice += productPrice;
            });

            // پیدا کردن جدول و ردیف دکمه حذف
            var tableBody = $('table tbody');
            var deleteButtonRow = tableBody.find('tr:last');
            
            // حذف ردیف دکمه حذف
            deleteButtonRow.remove();

            // اضافه کردن ردیف‌های جدید برای هر محصول انتخاب شده
            products.forEach(function(productId, index) {
                var productText = productTexts[index];
                var productPrice = productPrices[index];

                var newRow = `
                    <tr>
                        <td class="border border-gray-300 text-center p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40">
                                ${productText}
                            </p>
                            <input type="hidden" name="product[]" value="${productId}">
                        </td>
                        <td class="border border-gray-400 text-center p-1">
                            <div class="flex items-center justify-center space-x-reverse space-x-6">
                                <div>
                                    <label>استفاده شده</label>
                                    <input type="radio" name="product_status[]" value="used" ${capsuleStatus === 'used' ? 'checked' : ''}>
                                </div>
                                <div>
                                    <label>تمدید شارژ</label>
                                    <input type="radio" name="product_status[]" value="recharge" ${capsuleStatus === 'recharge' ? 'checked' : ''}>
                                </div>
                            </div>
                        </td>
                        <td class="border border-gray-400 text-[11.5px] text-center p-1">
                            <input type="text" class="w-full border rounded-md border-2 p-1 border-black/40 outline-none px-1.5" placeholder="توضیحات" value="${description}">
                        </td>
                    </tr>
                `;
                
                tableBody.append(newRow);
            });

            // اضافه کردن مجدد ردیف دکمه حذف
            var addButtonRow = `
                <tr>
                    <td class="border border-gray-300 text-center p-1" rowspan="2">
                        <div class="flex items-center justify-center">
                            <p onclick="showModal()" class="w-[50%] bg-green-500 text-white py-2 rounded-md sm:font-normal sm:text-sm text-[10px] border-black/40 cursor-pointer hover:bg-green-600 transition-colors">
                                <span class="font-bold">افزودن محصول</span>
                            </p>
                        </div>
                    </td>
                    <td class="border border-gray-400 text-center p-1" colspan="2">
                        <!-- این قسمت خالی است -->
                    </td>
                </tr>
            `;
            
            tableBody.append(addButtonRow);

            // به‌روزرسانی قیمت نهایی و تعداد کل
            updateTotalPrice();

            // بستن مودال
            closeModal();
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

@endsection
