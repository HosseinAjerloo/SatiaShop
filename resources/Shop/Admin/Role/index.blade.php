@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-6 ">
        <article class="space-y-5 bg-F1F1F1 p-3 ">
            <article class="flex items-center space-x-reverse space-x-2">
                <a href="{{route('admin.role.create')}}">
                    <img src="{{asset('capsule/images/plus.svg')}}" alt="">
                </a>
                <h1 class="font-semibold w-44">افزودن نقش</h1>
            </article>
            <form action="{{route('admin.role.store')}}" method="post" class="w-full">
                @csrf

                <table class="border-collapse  border border-gray-400 w-full table-fixed">
                    <thead class="bg-2081F2">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>ردیف</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>نام نقش</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white text-nowrap max-w-max">
                            <span>نام الگوی دسترسی</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                            <span>ویرایش</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>حذف</span>
                        </th>

                    </tr>

                    </thead>
                    <tbody id="tbody">
                    @foreach($roles as $key => $role)
                        <tr class=" @if(($key%2)==0) bg-gray-200/70 @else bg-white @endif ">
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{$key+1}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{$role->name}}
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                    {{implode(' - ',$roles[1]->permissions()->get()->pluck('persian_name')->toArray())}}
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full flex items-center justify-center ">
                                    <a href="{{route('admin.role.edit',$role)}}">
                                        <img src="{{asset('capsule/images/pen.svg')}}" alt="">
                                    </a>
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p class="sm:font-normal flex items-center justify-center sm:text-sm text-[13px] p-1 w-full underline underline-sky-500 underline-offset-4 decoration-sky-500 text-sky-600">
                                    <a href="{{route('admin.role.destroy',$role)}}">
                                        <img src="{{asset('capsule/images/delete.svg')}}" alt="">
                                    </a>
                                </p>
                            </td>


                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </form>


        </article>

    </section>

@endsection
@se
