<header class="px-3 py-4 bg-2081F2 h-14 flex items-center relative">
    <nav class="flex items-center justify-between w-full py-4 ">
        <a href="{{route('panel.admin')}}" class="flex items-center space-x-reverse space-x-2">
            <img src="{{asset("capsule/images/logo.svg")}}" alt="" class="cursor-pointer">
            <p class="font-bold text-white text-min ">
                سامانه مدیریت شارژ کپسول آتش نشانی
            </p>
        </a>
       <div class="">
           <img src="{{asset('capsule/images/userIcon.svg')}}" alt="" class="cursor-pointer profile " >
           <div class="text-lg absolute top-32 left-0  w-full md:w-1/2 lg:w-1/3 xl:w-1/4   profileBox px-4 py-1.5 flex flex-col justify-center space-y-4">
               <div class="flex updatePro items-center  space-x-reverse space-x-3 p-2 text-white font-bold rounded-lg bg-2081F2 cursor-pointer transition duration-500 hover:scale-105 admin-menu">
                   <i class="fas fa-user-edit"></i>
                   <span class="flex" >ویرایش پروفایل کاربری</span>
               </div>

               <a href="{{route('logout')}}" class="flex items-center  space-x-reverse space-x-3 p-2 text-white font-bold rounded-lg bg-2081F2 cursor-pointer transition duration-500 hover:scale-105 admin-menu">
                   <i class="fa fa-sign-out" aria-hidden="true"></i>
                   <span class="flex" >خروج از حساب کاربری</span>
               </a>
           </div>
       </div>
    </nav>
</header>
<div class="toast-container" id="toast-container">
</div>
@include('Toast.error')
@include('Toast.success')
