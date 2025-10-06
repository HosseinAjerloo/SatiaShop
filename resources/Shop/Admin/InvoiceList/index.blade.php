@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-6 ">
        <article class="space-y-5 bg-F1F1F1 p-3 ">
            <article class="flex items-center space-x-reverse space-x-2">

                <img src="{{asset('capsule/images/plus.svg')}}" alt="">

                <h1 class="font-semibold w-52">لیست فاکتور ها</h1>
            </article>
            <section class="w-full">
                @csrf

                <table class="border-collapse  border border-gray-400 w-full table-fixed">
                    <thead class="bg-2081F2">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>ردیف</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>فاکتور</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>وضعیت پرداخت</span>
                        </th>

                        <th class=" text-sm font-light px-2 leading-6 text-white text-nowrap max-w-max">
                            <span>شماره فاکتور</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white text-nowrap max-w-max">
                            <span>مشتری</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                            <span>نوع فاکتور</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>مبلغ</span>
                        </th>


                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>تاریخ</span>
                        </th>

                    </tr>

                    </thead>
                    <tbody id="tbody">

                    <tr class="bg-white ">
                        <td class="border border-gray-400  text-center  p-1">
                            <div class="w-full flex items-center  justify-center">
                                <img src="{{asset('capsule/images/searchIcon.svg')}}" alt="" class="w-5 h-5">

                            </div>
                        </td>


                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="number"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       disabled>
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="number"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       disabled>
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center ">
                            <div class="w-full flex items-center ">
                                <input type="number"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       data-name="reside_id">
                            </div>
                        </td>

                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       data-name="customer_name">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       data-name="reside_type">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       data-name="final_price">
                            </div>
                        </td>

                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center  ">
                                <img src="{{asset('capsule/images/date.svg')}}" alt=""
                                     class="w-5 h-5 sm:w-7 sm:h-7 date-icon cursor-pointer">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md startDate text-min text-center py-1 sm:w-4/5 mr-[2px] sm:mr-[15px]">
                                <input type="hidden" id="startDate" data-name="created_at">
                            </div>
                        </td>
                    </tr>
                    @foreach($resides as  $reside)
                        <tr class="@if( ($resides->firstItem() + $loop->index)%2==0) bg-white @else bg-gray-200/70 @endif">
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{ $resides->firstItem() + $loop->index}}
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center ">

                                <a href="@if($reside->reside_type=='sell') {{route('admin.sale.show', $reside)}}  @else {{route('admin.invoice.issuance.index', $reside)}} @endif"
                                   class="w-full flex items-center justify-center p-1">
                                    <img src="{{asset('capsule/images/eya.svg')}}" alt="">
                                </a>

                            </td>
                            <td class="border border-gray-400  text-center ">
                                <form class=" flex items-center justify-center"
                                      action="{{route('admin.invoice-list.payment',$reside)}}"
                                      method="POST">
                                    @csrf
                                    <div @if($reside->status_bank!='finished') onclick="payment(event)  @endif "
                                         class="h-full cursor-pointer flex items-center flex-col space-y-reverse space-y-1.5 w-full">

                                            <span class="text-sm">
                                              @if($reside->status_bank=='requested')
                                                    درانتظار پرداخت
                                                @elseif($reside->status_bank=='failed')
                                                    پرداخت موفقیت آمیز نبود
                                                @else
                                                    باموفقیت پرداخت شده است
                                                @endif
                                            </span>
                                            <img class="w-7 " src="@if($reside->status_bank=='requested')  {{asset('capsule/images/payment-waiting.svg')}}  @elseif($reside->status_bank=='failed') {{asset('capsule/images/close.svg')}} @else {{asset('capsule/images/success.svg')}}  @endif" alt="">
                                    </div>
                                </form>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p
                                    class="sm:font-normal sm:text-sm text-[13px] p-1 w-full underline underline-sky-500 underline-offset-4 decoration-sky-500 text-sky-600">
                                    {{$reside->id}}
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                    @if($reside->user->customer_type=='natural_person' or empty($reside->user->customer_type))
                                        {{$reside->user->fullName??''}}
                                    @else
                                        {{$reside->user->organizationORcompanyName??''}}
                                    @endif

                                </p>
                            </td>


                            <td class="border border-gray-400   text-center ">
                                <div class="w-full flex items-center justify-center p-1">
                                    {{$reside->reside_type=='sell'?'فروش':'شارژ و تمدید کپسول'}}
                                </div>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                    {{$reside->final_price!=0?numberFormat($reside->final_price):numberFormat($reside->totalPrice())}}
                                    ریال
                                </p>
                            </td>


                            <td class="border border-gray-400  text-center   p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{\Morilog\Jalali\Jalalian::forge($reside->created_at)->format('Y/m/d')}}
                                </p>
                            </td>

                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </section>


        </article>
        <x-paginate :items="$resides"/>
    </section>

@endsection
@section('script')
    @section('script')

        <script>
            let firstTrTbodyTable = document.querySelector('table tbody tr:first-child');
            let allInputs = firstTrTbodyTable.querySelectorAll('input');
            let getDate = firstTrTbodyTable.querySelector('input[type="hidden"]');
            let data = {}


            let mutations = new MutationObserver(function (mutations) {
                mutations.forEach(function (mutation) {
                    data[mutation.target.dataset.name] = mutation.target.value;
                    requestToServer();
                });
            });
            mutations.observe(getDate, {
                attributes: true
            });
            let valid = {
                'count_capsule': true,
                'reside_id': true
            }
            for (const input of allInputs) {
                input.addEventListener('input', function (event) {
                    if (event.target.value === '') {
                        if (event.target.dataset.name in data) {
                            delete data[event.target.dataset.name]
                        }
                    } else {
                        data[event.target.dataset.name] = event.target.value;
                    }
                    if (event.target !== undefined && (event.target.value.length >= 3 || (event.target.dataset.name in valid && valid[event.target.dataset.name]))) {
                        requestToServer();
                    } else {
                        requestToServer();
                    }
                })
            }

            function removeRow() {
                window.tbody.querySelectorAll('tr').forEach(function (row, index) {

                    if (index !== 0) {
                        row.remove();
                    }
                });
            }

            function requestToServer() {
                let xmlHttpRequest = new XMLHttpRequest();
                xmlHttpRequest.open("POST", "{{route('admin.invoice-list.search')}}");
                xmlHttpRequest.setRequestHeader('X-CSRF-Token', "{{csrf_token()}}")
                xmlHttpRequest.setRequestHeader("Content-Type", "application/json");
                xmlHttpRequest.send(JSON.stringify(data));
                xmlHttpRequest.onreadystatechange = function () {
                    if (xmlHttpRequest.readyState === 4 && xmlHttpRequest.status === 200) {
                        let responseXml = JSON.parse(xmlHttpRequest.response)
                        if (xmlHttpRequest.response !== '' && xmlHttpRequest.response !== undefined && !('errors' in responseXml) && responseXml.data.length !== 0) {
                            generateElement(responseXml);
                        }

                    }

                    if (xmlHttpRequest.status !== 200 && xmlHttpRequest.readyState === 4) {
                        let responseXml = JSON.parse(xmlHttpRequest.response)
                        if ('errors' in responseXml) {
                            for (const error in responseXml.errors) {
                                toast(responseXml.errors[error].toString(), false)
                            }

                        }

                    }
                }
            }

            function isEmptyObject(object) {
                return Object.keys(object).length === 0;
            }

            function generateElement(data) {
                removeRow()
                let myHtml = '';
                data.data.forEach(function (value, index) {

                    myHtml += `<tr class=" ${index % 2 == 0 ? 'bg-white ' : 'bg-gray-200/78'}   ">


                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    ${index + 1}
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center ">

                               <a href="${value.invoiceRoute}"
                                       class="w-full flex items-center justify-center p-1">
                                        <img src="{{asset('capsule/images/eya.svg')}}" alt="">
                                   </a>
                        </td>
                        <td class="border border-gray-400  text-center ">
                              <form method='POST' action="${value.paymentRoute}" class="flex items-center justify-center">
                              @csrf
                    <div ${value.status_bank != 'finished' ? 'onclick="payment(event)' : ''} "
                                         class="h-full cursor-pointer flex items-center flex-col space-y-reverse space-y-1.5 w-full">
                                        <span class="text-sm">
                                        ${value.status_bank == 'requested' ? 'درانتظار پرداخت' : value.status_bank == 'failed' ? 'پرداخت موفقیت آمیز نبود' : 'باموفقیت پرداخت شده است'}
                                        </span>
                                            <img class="w-7 "src="${value.image_payment}" alt="">

                                </div>


                              </form>
                            </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="sm:font-normal sm:text-sm  text-[13px] p-1 w-full underline underline-sky-500 underline-offset-4 decoration-sky-500 text-sky-600 ">
                                 <p>${value.id}</p>

                            </p>
                        </td>


                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                ${value.custumerName}

                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                ${value.type_change}
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full text-sky-600">
                               ${value.final_pricePersian}
                            </p>
                        </td>

                            <td class="border border-gray-400   text-center ">
                                <div class="w-full flex items-center justify-center p-1">
                                    ${value.jalalidate}
                            </div>
                        </td>


                    </tr>`;
                });
                window.tbody.insertAdjacentHTML('beforeend', myHtml)
            }

        </script>
        <script>
            let dateIcon = document.querySelector('.date-icon');
            dateIcon.onclick = function () {
                document.querySelector('.startDate').click();
            }
        </script>
        <script>
            function payment(event) {
                if (event.target.nodeName !== 'DIV')
                    event.target.parentElement.parentElement.submit()
                else
                    event.target.parentElement.submit()

            }
        </script>
    @endsection
