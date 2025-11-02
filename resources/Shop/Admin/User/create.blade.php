@extends('Admin.Layout.master')

@section('content')

    <article class="space-y-5 bg-F1F1F1 p-3 rounded-md">
        <form method="POST" action="{{route('admin.user.store')}}" id="form">
            @csrf
            <section class="space-y-5 w-full natural-person-section natural_person">


                <section class="flex items-center justify-between">
                    <div class="w-[49%] flex  flex-col  space-y-2">
                        <label for="" class="flex items-center font-bold">نام :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5 px-2" name="name"
                               value="{{old('name')}}">
                    </div>
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">نام خانوادگی :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5 px-2" name="family"
                               value="{{old('family')}}">
                    </div>
                </section>
                <section class="flex items-center justify-between">
                    <div class="w-[49%] flex  flex-col  space-y-2">
                        <label for="" class="flex items-center font-bold">کدملی :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5 px-2" name="national_code"
                               value="{{old('national_code')}}">
                    </div>
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">تلفن همراه :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-1.5 px-2" name="mobile"
                               value="{{old('mobile')}}">
                    </div>
                </section>
                <section class="flex items-center ">
                    <div class="w-full flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">نقش :</label>
                        <select class="js-example-tokenizer" multiple="multiple">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </section>


                <section class="flex items-center ">
                    <div class="w-full flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">آدرس :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow py-4 px-2 " name="address"
                               value="{{old('address')}}">
                    </div>
                </section>
{{--                <div class=" flex space-x-reverse space-x-4 ">--}}
{{--                    <label for="" class="flex items-center font-bold">این کاربر پشتیبان شود :</label>--}}
{{--                    <input type="checkbox" @if(old('type')=='admin') checked="checked" @endif class="border-0  w-5 accent-2081F2" name="type"--}}
{{--                           value="admin">--}}
{{--                </div>--}}
                <input type="hidden" name="roles" id="roles" >
            </section>
            <section class="flex items-center justify-center space-x-reverse space-x-3 p-5">
                <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                    <button class="submitBtn"> ثبت اطلاعات</button>
                </div>

            </section>
        </form>
    </article>

@endsection

@section('script')
    <script>
        $(".js-example-tokenizer").select2({
            tags: true,
        });

        $('.submitBtn').click(function (event) {
            event.preventDefault();
            window.roles.value = $(".js-example-tokenizer").val().join(',');
            $("#form").submit();

        });
    </script>

@endsection
