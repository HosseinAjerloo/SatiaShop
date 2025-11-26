@extends('Admin.Layout.master')

@section('content')

    <section class="modal transition-all fixed w-full h-screen left-0 invisible top-0 bottom-0 right-0  bg-transparent">
        <article class="absolute transition-all   top-[50%] left-1/2  translate-x-[-50%]   translate-y-[-80%] modal-white  w-full md:w-[70%] lg:w-1/2 xl:w-[40%] 2xl:w-1/4 h-[500] rounded-lg bg-white">
            <div class="p-2 ">
                <img class="w-7 cursor-pointer close-modal" src="{{asset('capsule/images/close.svg')}}" alt="">
            </div>
            <div  class="flex space-y-2 md:space-y-0 items-center justify-between flex-wrap p-10">
                <form onclick="(this.submit())" method="POST"
                      class="cursor-pointer p-5 w-full sm:w-[49%] flex-col space-y-3 flex items-center justify-center  h-1/2 rounded-lg border border-black border-solid">
                    @csrf
                    <img src="{{asset('capsule/images/kartkhan.svg')}}" alt="">
                    <h1 class="text-black text-md font-extrabold">پرداخت باکارتخوان</h1>

                </form  >
                <form onclick="(this.submit())" method="POST"
                      class="cursor-pointer p-5 w-full sm:w-[49%] flex-col space-y-3 flex items-center justify-center  h-1/2 rounded-lg border border-black border-solid">
                    @csrf
                    <img src="{{asset('capsule/images/dargah.svg')}}" alt="">
                    <h1 class="text-black text-md font-extrabold">پرداخت بادرگاه</h1>
                </form>
            </div>
        </article>
    </section>
    <section class=" space-y-6 ">
        <article class="space-y-5 bg-F1F1F1 p-3 ">

            <section class="w-full overflow-x-auto">
                @csrf

                <table class="border-collapse  border border-gray-400 min-w-full table-auto">
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
                                    <img src="{{asset('capsule/images/eya.svg')}}" alt="" class="w-10">
                                </a>

                            </td>
                            <td class="border border-gray-400  text-center ">
                                <div data-payment_gateway="{{route('admin.invoice-list.payment',$reside)}}"
                                     data-payment_pos="{{route('admin.invoice-list.pos',$reside)}}"
                                    class="@if($reside->type=='invoice' and $reside->status!='paid') select-payment @endif h-full cursor-pointer flex items-center flex-col space-y-reverse space-y-1.5 w-full">
                                    @if($reside->type=='reside')
                                        <span class="text-sm">
                                            نیاز به تایید فاکتور
                                        </span>
                                        <img class="w-8 " src="{{asset('capsule/images/invoice-wait.svg')}}  " alt="">
                                    @elseif($reside->final_price==0)
                                        <span class="text-sm">
                                            نیاز به پرداخت ندارد
                                            </span>
                                        <img class="w-8 " src="{{asset('capsule/images/free.svg')}}  " alt="">
                                    @elseif($reside->status_bank=='requested')
                                        <span class="text-sm">
                                            درانتظار پرداخت
                                            </span>
                                        <img class="w-8 " src="{{asset('capsule/images/payment-waiting.svg')}}" alt="">
                                    @elseif($reside->status_bank=='failed')
                                        <span class="text-sm">
                                            پرداخت موفقیت آمیز نبود
                                            </span>
                                        <img class="w-7 " src="{{asset('capsule/images/close.svg')}}" alt="">
                                    @else
                                        <span class="text-sm">
                                            پرداخت موفقیت آمیز
                                            </span>
                                        <img class="w-8 " src="{{asset('capsule/images/success.svg')}}" alt="">
                                    @endif
                                </div>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p
                                    class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  decoration-sky-500 ">
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
                console.log(data.data);
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

                                <div data-payment_gateway="${value.paymentGatewayRoute}"  data-payment_pos="${value.paymentPosRoute}"
                                   class="h-full ${value.type=='invoice' && value.status!='paid' ?'select-payment':''}  cursor-pointer flex items-center flex-col space-y-reverse space-y-1.5 w-full">
                                        <span class="text-sm">
                                             ${value.type == 'reside'?'نیاز به تایید فاکتور':value.status_bank == 'requested' ? 'درانتظار پرداخت' : value.status_bank == 'failed' ? 'پرداخت موفقیت آمیز نبود' : 'باموفقیت پرداخت شده است'}
                                        </span>
                                            <img class="w-7 "src="${value.image_payment}" alt="">

                                </div>



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
                window.tbody.insertAdjacentHTML('beforeend', myHtml);
                payment();

            }

        </script>
        <script>
            let dateIcon = document.querySelector('.date-icon');
            dateIcon.onclick = function () {
                document.querySelector('.startDate').click();
            }
        </script>
        <script>



            const payment=()=>{
                let btnSelectPayments = document.querySelectorAll('.select-payment');
                let modal = document.querySelector('.modal');
                let modalWhite = document.querySelector('.modal-white');
                btnSelectPayments.forEach((element)=>{
                    element.addEventListener('click',function (e){
                        modalWhite.children[1].children[0].action=e.currentTarget.dataset.payment_pos;
                        modalWhite.children[1].children[1].action=e.currentTarget.dataset.payment_gateway;
                        modal.style.transition =
                            'background-color 1s ease , backdrop-filter 1s ease , visibility 1s ease ';
                        modal.style.backgroundColor='rgba(0,0,0,.5)';
                        modal.style.visibility='visible';
                        modal.style.backdropFilter = 'blur(3px)';
                        modalWhite.style.transition =
                            'top 1s ease .7s ,left 1s ease .7s, transform 1s ease .7s,opacity 1s ease .7s,visibility 1s ease .7s ';
                        modalWhite.style.top='50%';
                        modalWhite.style.left='50%';
                        modalWhite.style.transform='translateX(-50%) translateY(-50%)'
                        modalWhite.style.opacity='1'
                        modalWhite.style.visibility='visible'


                    })
                })
            }
            payment();

            let btnCloseModal = document.querySelector('.close-modal');
            btnCloseModal.addEventListener('click', function (e) {
                const grandFatherElement = e.currentTarget.closest('article');
                grandFatherElement.style.transition ='transform .5s ease .5s,opacity .5s ease .5s,visibility .5s ease .5s';
                grandFatherElement.style.transform = 'translateY(-80%) translateX(-50%)';
                    grandFatherElement.style.opacity = 0;
                    grandFatherElement.style.visibility = 'hidden';
                    grandFatherElement.parentElement.style.transition =
                        'background-color 0s ease 1s, backdrop-filter 0s ease 1s, visibility 0s ease 1s';
                    grandFatherElement.parentElement.style.backgroundColor = 'transparent'
                    grandFatherElement.parentElement.style.backdropFilter = 'blur(0)';
                    grandFatherElement.parentElement.style.visibility = 'hidden';
            });



        </script>
@endsection
