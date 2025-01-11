@extends('Admin.Layout.master')

@section('content')

    <section class="px-5">
        <h1 class="font-bold text-sm">
            افزودن منو جدید :
        </h1>
        <form action="{{route('admin.menu.store')}}" method="POST"  class="mt-5 space-y-3">
            @csrf

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">نام منو:</h5>
                <input type="text" name="name" class="outline-none border border-black rounded-md w-48" value="{{old('name')}}">
            </div>


            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">وضعیت:</h5>
                <div class="flex items-center space-x-3 space-x-reverse">
                    <div>
                        <label>فعال</label>
                        <input type="radio" name="status" id="" value="active" @if(old('active')=='active') checked="checked" @endif  >

                    </div>
                    <div>
                        <label>غیرفعال</label>
                        <input type="radio" name="status" id="" value="inactive" @if(old('active')=='inactive') checked="checked" @endif  >
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">نمایش:</h5>
                <input type="text" class="outline-none border border-black rounded-md w-14" name="view_sort" value="{{old('view_sort')}}">
            </div>


            <div class="flex items-center justify-center  w-full">
               <button class="bg-2081F2 rounded-md py-1.5 w-full text-white">ارسال</button>
            </div>
        </form>
    </section>


@endsection
@section('script')
<script>
    $(document).ready(function(){
        var upload=$(".upload");
        $(upload).click(function(){
           $("#upload").trigger('click')
        })
    })
</script>

@endsection
