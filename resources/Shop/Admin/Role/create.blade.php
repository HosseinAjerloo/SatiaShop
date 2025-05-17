@extends('Admin.Layout.master')

@section('content')

    <section class="px-5">
        <h1 class="font-bold text-sm">
            افزودن دسته بندی :
        </h1>
        <form action="{{route('admin.role.store')}}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-3" id="form">
            @csrf

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">نام نقش:</h5>
                <input type="text" name="name" class="outline-none border border-black rounded-md w-64" value="{{old('name')}}">
            </div>

            <div class="flex items-center space-x-reverse space-x-8">
                <h5 class="text-min font-light w-28">الگوی دسترسی:</h5>
                <select  id="" class="outline-none border border-black rounded-md  w-64 js-example-tokenizer" multiple="multiple">

                    @foreach($permissions as $permission)
                        <option value="{{$permission->id}}">{{$permission->persian_name}}</option>

                    @endforeach
                </select>
                <input type="hidden" name="permission_id" id="permission_id">
            </div>

            <div class="flex items-center justify-center  w-full">
               <button class="bg-2081F2 rounded-md py-1.5 w-full text-white submitBtn">ثبت</button>
            </div>
        </form>
    </section>


@endsection
@section('script')
<script>
    $('.submitBtn').click(function (event){
        event.preventDefault();
        window.permission_id.value=$(".js-example-tokenizer").val().join(',');
        $("#form").submit();

    });
    $(".js-example-tokenizer").select2({
        tags: true,
    })

</script>

@endsection
