@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-6 ">

        <article class="px-3 space-y-1.5">
            <div class="flex items-center space-x-reverse space-x-2">
                <img src="{{asset('capsule/images/charging-operation-desc.svg')}}" alt="">
                <h2 class="font-bold">لیست کپسول های در انتظار شارژ</h2>
            </div>
            <p class="mr-8 font-thin">
                در صورت انجام عملیات شارژ ، کپسول از لیست زیر <span class="text-red-700">حذف</span> می شود
            </p>
        </article>
        <article class="space-y-5 bg-F1F1F1 p-3 ">

            <form action="" method="post" class="w-full overflow-x-auto sm:overflow-visible">
                @csrf

                <table class="border-collapse  border border-gray-400 min-w-full w-full table-auto">
                    <thead class="bg-2081F2">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white w-[10%]">
                            <span>ردیف</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>کدیکتا</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>عنوان محصول</span>
                        </th>

                        <th class=" text-sm font-light px-2 leading-6 text-white text-nowrap max-w-max ">
                            <span>نام مشتری/سازمان</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white max-w-max  w-[10%]">
                            <span>عملیات شارژ</span>
                        </th>

                    </tr>

                    </thead>
                    <tbody id="tbody">

                    <tr class="bg-white ">
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center  ">
                                <div class="w-full flex items-center ">
                                    <input type="text"
                                           class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                           disabled>
                                </div>
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       data-name="uniqueCode">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       data-name="product_name">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       data-name="name">
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
                    @foreach($resideItems as  $resideItem)
                        <tr class="basic-data @if( ($resideItems->firstItem() + $loop->index)%2==0) bg-white @else bg-gray-200/70 @endif">
                            <td class="border border-gray-400  text-center  p-1 ">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{ $resideItems->firstItem() + $loop->index}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{$resideItem->unique_code}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{$resideItem->product->removeUnderLine??''}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{$resideItem->reside->user->fullName??''}}

                                </p>
                            </td>
                            <td class="border border-gray-400 flex items-center justify-center cursor-pointer text-center  p-1">
                                <a href="{{route('admin.invoice.issuance.operation', [$resideItem->reside,$resideItem])}}">
                                    <img src="{{asset('capsule/images/activecharging.svg')}}" alt=""
                                         class="w-10 border-none">

                                </a>
                            </td>

                    @endforeach


                    </tbody>
                </table>

            </form>


        </article>
        <x-paginate :items="$resideItems"/>
    </section>

@endsection
@section('script')
    <script>
        let inputs = document.querySelectorAll('td div input:not([disabled])');
        let page = document.querySelector('.page');
        let nexPageUrl = '';
        let oldNexPageUrl = '';
        let hasMorePages = false;
        let isRemove=false;
        let urlRequest = "{{route('admin.charging-operation.searchAjax')}}";
        inputs.forEach((input) => {
            input.addEventListener('input', changeValue)
        });
        let count = 0;
        const formData = new FormData();

        function changeValue(e) {

            isRemove=true;
            formData.append(e.target.dataset.name, e.target.value)
            request(urlRequest);
        }

        const removeTrTable = () => {
            let tresTable = document.querySelectorAll('.basic-data');

            tresTable.forEach((tr) => {
                tr.remove();
            })
        }

        const request = (url) => {
            let html = '';
            let httpRequest = new XMLHttpRequest();
            httpRequest.open('POST', url);
            httpRequest.setRequestHeader('X-CSRF-TOKEN', "{{csrf_token()}}");
            httpRequest.send(formData)
            httpRequest.onreadystatechange = () => {
                if (httpRequest.status === 200 && httpRequest.readyState === 4) {
                    let response = JSON.parse(httpRequest.response);
                        if (isRemove)
                        {
                            removeTrTable();
                            count=0;
                        }
                    if (response.status) {
                        nexPageUrl = response.nexPageUrl;
                        hasMorePages = response.hasMorePages

                        response.data.forEach((value, index) => {

                            html = ` <tr class="basic-data ${count % 2 == 0 ? 'bg-white' : 'bg-gray-200/70'}  \">
                            <td class="border border-gray-400  text-center  p-1 ">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                ${count + 1}

                        </p>
                    </td>
                    <td class="border border-gray-400  text-center  p-1">
                        <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                        ${value.unique_code}
                        </p>
                    </td>
                <td class="border border-gray-400  text-center  p-1">
                        <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                        ${value.product_name}
                        </p>
                    </td>
                    <td class="border border-gray-400  text-center  p-1">
                        <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                          ${value.fullName}

                        </p>
                    </td>
                     <td class="border border-gray-400 flex items-center justify-center cursor-pointer text-center  p-1">
                                <a href="${value.link}">
                                    <img src="${value.image}" alt=""
                                         class="w-10 border-none">

                                </a>
                            </td>
                    `;
                            window.tbody.insertAdjacentHTML('beforeend', html)
                            count++
                        })

                        page.style.display = 'none';
                    }
                }
            }
        }


        window.addEventListener('scroll', function (e) {
            let totalScroll = document.body.offsetHeight - 200;
            let onScroll = window.innerHeight + window.scrollY;
            if (onScroll >= totalScroll && hasMorePages && oldNexPageUrl!=nexPageUrl) {
                isRemove=false
                request(nexPageUrl);
                oldNexPageUrl=nexPageUrl;
            }
        })

    </script>
@endsection
