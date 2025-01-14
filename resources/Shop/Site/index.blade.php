@extends('Site.Layout.master')

@section('content')

    <section class="mt-5 space-y-12">

        @foreach($menus as $menu)
            <div
                class="flex items-center flex-wrap justify-between relative bg-F2F2F2 border border-black/25 rounded-md rounded-ss-none space-y-3  p-2">
                <div
                    class="text-min font-bold absolute -top-[31px] -right-[1px] bg-F2F2F2 px-2 py-1.5   border border-b-0 border-black/25 rounded-md rounded-s-none rounded-ee-none">
                    {{$menu->name??''}}
                </div>

                @foreach($menu->categoryShow() as $category)
                    <a href="{{route('panel.products',$category->name)}}"
                        class="flex items-start justify-center flex-col border-2 border-black/30 rounded-md  box-border bg-white w-[49%] md:w-[24%] xl:w-[18%]">

                        <div class="flex items-center justify-center w-full p-1.5 h-36">
                            <img src="{{$category->image?->path}}" alt="" class="w-full h-full object-contain">
                        </div>

                        <div class="bg-F2F2F2 p-2 w-full">
                            <p class="text-min_sm">
                               {{$category->name??''}}
                            </p>
                        </div>

                    </a>
                @endforeach

            </div>
        @endforeach

    </section>


@endsection
