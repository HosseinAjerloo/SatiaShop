
<div  class="editPro @if($errors->first('updateUserProfile')) editProActive  @endif w-full   sm:w-1/2  backdrop-blur-md fixed  left-1/2  rounded-lg   ">
    <div class="w-full h-full shadow shadow-black/35 p-3">
        <div>
            <img src="{{asset("capsule/images/close.svg")}}" alt="" class="cursor-pointer close-profile">
        </div>
        <div class="font-bold text-2xl py-4 flex justify-center ">
            ویرایش اطلاعات
        </div>

        <form action="{{route('admin.updateUser')}}" class="w-full flex mt-5  " method="POST">
            @csrf
            @method('PUT')
            <section class="flex-wrap flex w-full  ">
                <div class="w-full xl:w-1/2  flex justify-content-around items-center mt-5">
                    <label class="text-black w-3/12">نام:</label>
                    <input type="text" name="name" value="{{old('name',$user->name??'')}}" class="w-[73%] px-2 py-1.5 border border-black rounded-md" >
                </div>
                <div class="w-full xl:w-1/2  flex justify-content-around items-center mt-5">
                    <label class="text-black w-3/12">نام خانوادگی:</label>
                    <input type="text" name="family" value="{{old('family',$user->family??'')}}" class="w-[73%] px-2 py-1.5 border border-black rounded-md">
                </div>

                <div class="w-full xl:w-1/2  flex justify-content-around items-center mt-5">
                    <label class="text-black w-3/12">شماره ثابت:</label>
                    <input type="text" name="tel" value="{{old('tel',$user->tel??'')}}" class="w-[73%] px-2 py-1.5 border border-black rounded-md">
                </div>
                <div class="w-full xl:w-1/2  flex justify-content-around items-center mt-5">
                    <label class="text-black w-3/12">شماره موبایل:</label>
                    <input type="text" name="mobile" value="{{old('mobile',$user->mobile??'')}}" class="w-[73%] px-2 py-1.5 border border-black rounded-md">
                </div>

                <div class="w-full xl:w-1/2  flex justify-content-around items-center mt-5">
                    <label class="text-black w-3/12">کدملی:</label>
                    <input type="text" name="national_code" value="{{old('national_code',$user->national_code??'')}}" class="w-[73%] px-2 py-1.5 border border-black rounded-md">
                </div>
                <div class="w-full xl:w-1/2  flex justify-content-around items-center mt-5">
                    <label class="text-black w-3/12">ایمیل:</label>
                    <input type="text" name="email" value="{{old('email',$user->email??'')}}" class="w-[73%] px-2 py-1.5 border border-black rounded-md">
                </div>
                <div class="w-full space-y-2  flex-wrap flex  items-center mt-5">
                    <label class="text-black  w-full">رمز عبور قبلی:</label>
                    <input class="w-[99%] py-1.5 border border-black rounded-lg px-2" name="oldPass">
                </div>
                <div class="w-full xl:w-1/2  flex justify-content-around items-center mt-5">
                    <label class="text-black w-3/12">رمز عبور جدید:</label>
                    <input type="password" name="password" class="w-[73%] px-2 py-1.5 border border-black rounded-md">
                </div>
                <div class="w-full xl:w-1/2  flex justify-content-around items-center mt-5">
                    <label class="text-black w-3/12">تکرار رمز عبور جدید:</label>
                    <input type="password" name="password_confirmation" class="w-[73%] px-2 py-1.5 border border-black rounded-md">
                </div>

                <div class="w-full space-y-2  flex-wrap flex  items-center mt-5">
                    <label class="text-black  w-full">ادرس:</label>
                    <textarea class="w-[99%] resize-y h-36 border border-black rounded-lg p-4" name="address">{{old('address',$user->address??'')}}</textarea>
                </div>
                <button class="mt-5 py-4 rounded-md bg-2081F2 w-full text-white text-lg cursor-pointer">ویرایش</button>
            </section>
        </form>
    </div>

</div>
