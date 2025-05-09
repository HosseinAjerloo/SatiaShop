@extends('Admin.Layout.master')

@section('content')

    <section class="px-5 mt-4">
        <h1 class="font-bold text-sm">
            ویرایش منو :
        </h1>
        <form action="{{route('admin.menu.update',$menu->id)}}" method="POST"  class="mt-5 space-y-3">
            @csrf
            @method('PUT')

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">نام منو:</h5>
                <input type="text" name="name" class="outline-none border border-black rounded-md w-48" value="{{old('name',$menu->name)}}">
            </div>


            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">وضعیت:</h5>
                <div class="flex items-center space-x-3 space-x-reverse">
                    <div>
                        <label>فعال</label>
                        <input type="radio" name="status" id="" value="active" @if(old('status',$menu->status)=='active') checked="checked" @endif  >
                    </div>
                    <div>
                        <label>غیرفعال</label>
                        <input type="radio" name="status" id="" value="inactive" @if(old('status',$menu->status)=='inactive') checked="checked" @endif  >
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">ترتیب نمایش:</h5>
                <input type="text" class="outline-none border border-black rounded-md w-14" name="view_sort" value="{{old('view_sort',$menu->view_sort)}}">
            </div>
            <a href="{{route('admin.menu.destroy',$menu)}}" class="flex items-center space-x-reverse space-x-8 ">
                <h5 class="text-min font-light w-28">حذف دسته:</h5>
                <div
                    class=" border border-black rounded-md px-2 bg-red-500 py-1.5 flex items-center justify-center space-x-1 space-x-reverse">
                    <p class="text-min text-white font-bold">حذف کردن</p>
                    <img src="{{asset('capsule/images/delete.svg')}}" alt="" class="w-5">
                </div>
            </a>


            <div class="flex items-center justify-center  w-full">
               <button class="bg-2081F2 rounded-md py-1.5 w-full text-white">ویرایش</button>
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
