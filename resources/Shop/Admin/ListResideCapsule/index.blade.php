@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-6 ">
        <article class="space-y-5 bg-F1F1F1 p-3 ">
            <article class="flex items-center space-x-reverse space-x-2">
                <a href="{{route('admin.chargingTheCapsule.index')}}">
                    <img src="{{asset('capsule/images/plus.svg')}}" alt="">
                </a>
                <h1 class="font-semibold w-44">رسیدهای کپسول</h1>
            </article>
            <form action="" method="post" class="w-full">
                @csrf

                <table class="border-collapse  border border-gray-400 w-full table-fixed">
                    <thead class="bg-2081F2">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>ردیف</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>تاریخ</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white text-nowrap max-w-max">
                            <span>نوع رسید</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white text-nowrap max-w-max">
                            <span>نام مشتری/سازمان</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                            <span>تعداد کپسول</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>شماره رسید</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>فایل ضمیمه</span>
                        </th>
                        @can('admin.invoice.issuance.index')
                            <th class=" text-sm font-light px-2 leading-6 text-white ">
                                <span>صدور فاکتور</span>
                            </th>
                        @endcan
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>نام پذیرنده</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>چاپ</span>
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
                            <div class="w-full flex items-center  ">
                                <img src="{{asset('capsule/images/date.svg')}}" alt=""
                                     class="w-5 h-5 sm:w-7 sm:h-7 date-icon cursor-pointer">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md startDate text-min text-center py-1 sm:w-4/5 mr-[2px] sm:mr-[15px]">
                                <input type="hidden" id="startDate" data-name="created_at">
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
                                       data-name="customer_name">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="number"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       data-name="count_capsule" >
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center ">
                            <div class="w-full flex items-center ">
                                <input type="number"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       data-name="reside_id">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center ">
                            <div class="w-full flex items-center ">
                                <input type="number"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                      disabled="disabled">
                            </div>
                        </td>
                        @can('admin.invoice.issuance.index')

                            <td class="border border-gray-400   text-center p-1">
                                <div class="w-full flex items-center ">
                                    <input type="text"
                                           class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                           disabled>
                                </div>
                            </td>
                        @endcan
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       data-name="operator_name">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       disabled>
                            </div>
                        </td>

                    </tr>
                    @foreach($resides as $key=> $reside)
                        <tr class="@if($key%2==0) bg-white @else bg-gray-200/70 @endif">
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{$key+1}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{\Morilog\Jalali\Jalalian::forge($reside->created_at)->format('Y/m/d')}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{$reside->reside_type=='sell'?'فروش':'شارژ و تمدید کپسول'}}
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
                            <td class="border border-gray-400   text-center p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                    @if($reside->reside_type=='sell')
                                    {{$reside->resideItem->sum('amount')}}
                                    @else
                                        {{$reside->resideItem->count()}}
                                    @endif
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <a href="@if($reside->reside_type=='recharge') {{route('admin.chargingTheCapsule.edit',$reside)}} @else {{route('admin.sale.edit',$reside)}} @endif"
                                   class="sm:font-normal sm:text-sm text-[13px] p-1 w-full underline underline-sky-500 underline-offset-4 decoration-sky-500 text-sky-600">
                                    {{$reside->id}}
                                </a>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                @if($reside->file)
                                <a href="{{route('admin.resideCapsule.download',$reside)}} "
                                   class="flex items-center justify-center">
                                    <img src="{{asset("capsule/images/fileDownload.svg")}}" alt="" class="max-w-max ">
                                </a>
                                @else
                                    ---
                                @endif
                            </td>
                            @can('admin.invoice.issuance.index')
                                <td class="border border-gray-400   text-center ">
                                    <div class="w-full flex items-center justify-center p-1">
                                        @if($reside->reside_type=='sell')

                                            <a href="@if($reside->status=='paid') #  @else {{route('admin.sale.show',$reside->id)}} @endif">
                                                <img
                                                    src="@if($reside->status=='paid'){{asset('capsule/images/finalFactor.svg')}} @else {{asset("capsule/images/hand-Invoice.png")}} @endif "
                                                    alt=""
                                                    class="w-8 h-8">
                                            </a>

                                        @else
                                            <a href="@if($reside->status=='paid') #  @else {{route('admin.invoice.issuance.index',$reside->id)}} @endif">
                                                <img
                                                    src="@if($reside->status=='paid'){{asset('capsule/images/finalFactor.svg')}} @else {{asset("capsule/images/hand-Invoice.png")}} @endif"
                                                    alt=""
                                                    class="w-8 h-8">
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            @endcan
                            <td class="border border-gray-400   text-center ">
                                <div class="w-full flex items-center justify-center p-1">
                                    {{$reside->operator->fullName??''}}
                                </div>
                            </td>
                            <td class="border border-gray-400   text-center ">
                                @if($reside->reside_type=='sell')
                                    <a href=" @if($reside->status=='paid') {{route('admin.sale.printFactor',$reside)}} @else # @endif"
                                       class="w-full flex items-center justify-center p-1">
                                        <img src="{{asset('capsule/images/printerIcon.svg')}}" alt="">
                                    </a>

                                @else
                                    <a href=" @if($reside->status=='paid') {{route('admin.invoice.issuance.printFactor',$reside)}} @else {{route('admin.chargingTheCapsule.printReside',$reside)}} @endif"
                                       class="w-full flex items-center justify-center p-1">
                                        <img src="{{asset('capsule/images/printerIcon.svg')}}" alt="">
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </form>


        </article>

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
                }else {
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
            xmlHttpRequest.open("POST", "{{route('admin.resideCapsule.search')}}");
            xmlHttpRequest.setRequestHeader('X-CSRF-Token', "{{csrf_token()}}")
            xmlHttpRequest.setRequestHeader("Content-Type", "application/json");
            xmlHttpRequest.send(JSON.stringify(data));
            xmlHttpRequest.onreadystatechange = function () {
                if (xmlHttpRequest.readyState === 4 && xmlHttpRequest.status === 200) {
                    let responseXml = JSON.parse(xmlHttpRequest.response)
                    console.log(responseXml);
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
                myHtml += `<tr class=" bg-white  bg-gray-200/78 ">
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    ${index + 1}
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    ${value.jalalidate}
                            </p>
                        </td>
                             <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                ${value.type_change}

                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                ${value.custumerName}

                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                ${value.capsuleCount}
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full underline underline-sky-500 underline-offset-4 decoration-sky-500 text-sky-600">
                               <a href="${value.update}">${value.id}</a>
                            </p>
                        </td>
                         <td class="border border-gray-400   text-center p-1">
                                    <a href="${(value.download)? value.download : '#'}"
                                   class="flex items-center justify-center">
                                   ${(value.download)? '<img src="{{asset("capsule/images/fileDownload.svg")}}" alt="" class="max-w-max ">' : '--'}

                                </a>
                         </td>
            <td class="border border-gray-400   text-center ">
                <div class="w-full flex items-center justify-center p-1">
                        <a href="${value.route}">
                                        <img src="${value.img}" alt="" class="w-8 h-8">
                                    </a>
                                </div>
                            </td>
                            <td class="border border-gray-400   text-center ">
                                <div class="w-full flex items-center justify-center p-1">
                                    ${value.operatorName}
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center ">

                               <a href="${value.routePrint}"
                                       class="w-full flex items-center justify-center p-1">
                                        <img src="{{asset('capsule/images/printerIcon.svg')}}" alt="">
                                    </a>
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
@endsection
