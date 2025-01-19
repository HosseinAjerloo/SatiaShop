<header class="px-3 py-2.5 bg-2081F2 h-16 flex items-center">
    <nav class="flex items-center justify-between w-full">
        <div class="flex items-center space-x-reverse space-x-2">
            <img src="{{asset("capsule/images/logo.svg")}}" alt="">
            <p class="font-bold text-white text-sm ">
                سامانه مدیریت شارژ کپسول آتش نشانی
            </p>
        </div>

       <a    href="{{route('panel.cart.index')}}"  class="flex items-center space-x-4 space-x-reverse cartUrl">
           <div class="relative">
               <img src="{{asset('capsule/images/orderWhitw.svg')}}" alt="" class="w-8 h-8">
               <span class="absolute text-min top-0 -right-1 w-5 h-5 bg-sky-800 flex items-center justify-center text-white font-bold rounded-50%  shadow-inset_white">{{$countCart}}</span>
           </div>
           <img src="{{asset('capsule/images/userIcon.svg')}}" alt="">
       </a>


    </nav>
</header>
<div class="toast-container" id="toast-container">
</div>
@include('Toast.error')
@include('Toast.success')
