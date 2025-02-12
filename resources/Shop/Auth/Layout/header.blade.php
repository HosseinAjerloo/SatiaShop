<header class="px-3 py-4 bg-2081F2 h-10 flex items-center">
    <nav class="flex items-center justify-between w-full">
        <div class="flex items-center space-x-reverse space-x-2">
            <img src="{{asset('capsule/images/logo.svg')}}" alt="">
            <p class="font-bold text-white text-min ">
                سامانه مدیریت شارژ کپسول آتش نشانی
            </p>
        </div>
    </nav>
</header>
<div class="toast-container" id="toast-container">
</div>
@include('Toast.error')
@include('Toast.success')
