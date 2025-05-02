@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-3 relative w-4/5 mx-auto">
        <article class="space-y-5 bg-F1F1F1 p-6 rounded-md">

            <article class="flex justify-between items-center">
                <div class="flex items-center space-x-reverse space-x-2 w-1/2">
                    <img src="{{asset("capsule/images/blue-user.svg")}}" alt="">
                    <div class="flex items-center space-x-2 space-x-reverse">
                        <h1 class="font-bold text-sm sm:tetx-base">نام مشتری:</h1>
                        <span class="text-sm sm:tetx-base">حسین آجرلو</span>
                    </div>

                </div>
                <div class="flex items-center justify-end space-x-reverse  space-x-2 w-1/2">
                    <h1 class="font-bold text-sm sm:tetx-base">تاریخ:</h1>
                    <span class="text-sm sm:tetx-base">1404/02/01</span>
                </div>
            </article>
        </article>
        <article class="space-y-5 bg-F1F1F1 p-6 rounded-md ">

            <form action="{{route('hossein.back')}}" method="post" class="w-full">
                @csrf
                <x-capsules.water-and-foam/>
                <div></div>

            </form>


        </article>

    </section>

@endsection
@section('script')
    <script>
        function generateQrCode(){
            let qrCodeElement = document.querySelectorAll('.qrcode');
            let count=0;
            let color='';
            for (const imgQr of qrCodeElement)
            {
                if(count%2===0){
                    color='#ffffff';
                }else {
                    color='#e5e7eb';
                }
                count+=1;
                QRCode.toCanvas(imgQr,'hossein Ajerloo', {
                    width: 50,
                    color: {
                        dark: '#000000',
                        light: color
                    }
                });

            }
        }
        generateQrCode();
    </script>

    <script>
        CKEDITOR.replace( 'description' ,{
            versionCheck: false,
            language: 'fa',
            removeButtons: 'Image,Link,Source,About'
        });
    </script>
@endsection
