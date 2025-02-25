@extends('Auth.Layout.master')


@section('content')

    <div class="flex items-center justify-center">
        <img src="{{asset('capsule/images/capsule.png')}}" alt="">
    </div>

    <section class="flex items-center justify-center">
        <form action="" class="space-y-3.5 " method="POST" id="form">
            @csrf

            <div class="flex items-center justify-between space-x-reverse space-x-2 w-full  ">
                <div class="flex items-center  border-2 px-2 h-12 rounded-md border-black">
                    <img src="{{asset('capsule/images/phone.svg')}}" alt="" class="w-6 h-6">
                    <input type="text"
                           class=" mobile w-full h-full inline-block outline-none px-2 placeholder:text-center placeholder:text-sm"
                           placeholder="شماره همراه  (*********09)" name="mobile" value="{{old('mobile')}}">
                </div>
                <button type="button" class="text-mini-base bg-2081F2 w-24   h-12 text-white rounded-md text-center flex items-center justify-center cursor-pointer send">
                    ارسال
                    کد
                </button>

            </div>
            <div class="flex items-center space-x-reverse space-x-2 w-full border-black border-2 px-2 h-12 rounded-md">
                <img src="{{asset('capsule/images/key-black.svg')}}" alt="" class="w-6 h-6">
                <input type="text"
                       class="w-full h-full py-1.5 outline-none px-2  placeholder:text-center  placeholder:text-sm"
                       placeholder="کد ارسال شده به تلفن همراه " name="code" value="{{old('code')}}">
            </div>
            <div class="flex items-center space-x-reverse space-x-2 w-full border-black border-2 px-2 h-12 rounded-md">
                <img src="{{asset('capsule/images/key-black.svg')}}" alt="" class="w-6 h-6">
                <input type="password"
                       class="w-full h-full py-1.5 outline-none px-2  placeholder:text-center  placeholder:text-sm"
                       placeholder="کلمه عبور جدید (حروف و عدد)" name="password">
            </div>
            <div class="flex items-center justify-center text-mini-mini-base text-center leading-6 text-black/35 font-bold time w-full">
            </div>
            <button type="button"  class=" bg-2081F2 text-sm w-52 h-10 rounded-md text-white font-bold submit">
                ورود به
                حساب کاربری
            </button>

        </form>
    </section>
@endsection
@section('script-tag')

    <script>
        $(document).ready(function () {
            let sendBtn = $(".send");
            let tokenCSRF = "{{csrf_token()}}";
            $(sendBtn).click(function (event) {

                let mobile=$(".mobile").val();
                event.preventDefault();
                console.log(tokenCSRF);
                $.ajax({
                    'type': "POST",
                    'url': "{{route('createCode')}}",
                    data: {_token: tokenCSRF,mobile:mobile},
                    success: function (response) {
                        time(response.message);
                        $(sendBtn).attr("disabled","disabled");
                        $(sendBtn).removeClass('bg-gradient-to-b from-80C714 to-268832');
                        $(sendBtn).addClass('bg-gray-400');
                        toast('پیامک به شماره موبایل وارده ارسال شد',true);
                    },
                    error: function (error) {
                        toast(error.responseJSON.message,false);
                        close();
                    }
                })
            })
        });
    </script>

    <script>
        function close()
        {
            $(document).ready(function () {
                let toast = $('.toast');
                setTimeout(function () {
                    $(toast).addClass('-translate-y-7');
                    $(toast).remove();
                }, 9000)


                let closeToast = $('.close-toast');
                $(closeToast).click(function () {
                    $(toast).addClass('invisible');
                    $(toast).remove();
                });
            })
        }
    </script>
    <script>
        function time(message){
            var sendBtn=document.getElementsByClassName("send")[0];

            var countDownDate = new Date(message.created_at)

            var now = new Date("{{\Carbon\Carbon::now()->subMinutes(3)->toDateTimeString()}}")


            var x = setInterval(function () {
                now.setSeconds(now.getSeconds() + 1)



                var distance = countDownDate - now;

                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                var text = '';
                if (minutes > 0) {
                    text += 'مدت زمان باقی مانده تا دریافت مجدد کد ' + minutes + ' دقیقه و ' + seconds + ' ثانیه  '
                } else {
                    text = 'مدت زمان باقی مانده تا دریافت مجدد کد ' + seconds + ' ثانیه  '
                }
                document.getElementsByClassName("time")[0].innerHTML = text

                if (distance < 0) {
                    document.getElementsByClassName("time")[0].innerHTML = ''

                    clearInterval(x);
                    sendBtn.removeAttribute('disabled')
                    sendBtn.classList.remove('bg-gray-400')
                    sendBtn.classList.add('bg-gradient-to-b','from-80C714','to-268832');

                }
                let form = document.getElementById('form');

                form.action = message.route
            }, 1000);
        }
        $('.submit').click(function (e){
            e.preventDefault();
            if($('#form').attr("action")!='')
            {
                $('#form').submit();
                return;
            }
            toast('لطفا شماره موبایل خود را وارد کنید وسپس بر روی دکمه ارسال کد کلید کنید',false)

        })


    </script>


    <script>
        function toast(message, status) {
            showToast(message);
            if (!status) {
                $(".progress-bar div").css({'background-color': 'red'})
            }

        }
    </script>
@endsection
