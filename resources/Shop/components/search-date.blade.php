<section class="flex w-full items-center justify-center flex-wrap ">
    <div class="w-1/4 md:w-[5%] flex  items-center justify-center border-black rounded-md p-1 submit_date cursor-pointer" data-date="1">
        <img src="{{asset("capsule/images/1Mount.svg")}}" alt="">
    </div>
    <div class="w-1/4 md:w-[5%] flex items-center justify-center submit_date cursor-pointer border-black rounded-md p-1" data-date="3">
        <img src="{{asset("capsule/images/3Mount.svg")}}" alt="">
    </div>
    <div class="w-1/4 md:w-[5%] flex items-center justify-center submit_date cursor-pointer border-black rounded-md p-1" data-date="6">
        <img src="{{asset("capsule/images/6Mount.svg")}}" alt="">
    </div>
    <div class="w-1/4 md:w-[5%] flex items-center justify-center border-black rounded-md p-1  date cursor-pointer">
        <img src="{{asset("capsule/images/date.svg")}}" alt="">
    </div>

       <div class="  flex flex-wrap items-center justify-between w-full lg:w-3/4   px-2 py-4 picker  md:space-y-0">
           <div class="w-full justify-center lg:justify-between flex-wrap md:w-[33%] flex items-center space-x-2 space-x-reverse space-y-2 ">
               <span class="w-full lg:w-[20%] text-center">از تاریخ</span>
               <input type="text"  class=" lg:w-[75%] py-1.5 border border-black/25 rounded-lg px-2 text-center startDate">
           </div>
           <div class="w-full justify-center flex-wrap md:w-[33%] flex items-center space-x-2 space-x-reverse space-y-2 ">
                <span class="w-full lg:w-[20%] text-center">تا تاریخ</span>
               <input type="text"  class=" lg:w-[75%] py-1.5 border border-black/25 rounded-lg px-2 text-center endDate">
           </div>
           <div class="w-full md:w-[33%] justify-center flex-wrap  flex items-center space-x-2 space-x-reverse space-y-2">
               <span class="w-full lg:w-[20%] text-center">&nbsp;</span>
               <button class="w-full lg:w-[75%] mt-4 md:mt-0 bg-green-400  py-1.5  rounded-lg  border border-gray-600 text-white affect-shadow submit-date">گزارش گیری</button>
           </div>
       </div>

</section>
<form id="form" class="flex items-center justify-between space-x-reverse space-x-3 px-2 mt-5" action="{{$routeSearch}}">

   <a @if($routeList!='null') href="{{$routeList}}" @endif class="flex items-center space-x-reverse space-x-2">

    @if ($imagePath!='null')
            <img src="{{$imagePath}}" alt="">

    @else
        <img src="{{asset("capsule/images/plus.svg")}}" alt="">
    @endif
            <h1 class="text-min font-bold">{{$name}}</h1>
    </a>
   @if($attributes->get('shoSearch')!='false')
        <div class="border border-black flex items-center py-1.5 px-2 rounded-md">
            <input type="text" placeholder="{{$placeholder}}"class="placeholder:text-min placeholder:text-black/35 outline-none searchInput" name="name" id="input_search">

            <img src=" {{asset('capsule/images/search.svg')}}"  alt="" class="search cursor-pointer">

        </div>
   @endif
    <input type="hidden" name="date" id="input_date">
    <input class="startDate" type="hidden" name="startDate" id="startDate"/>
    <input class="endDate" type="hidden" name="endDate" id="endDate"/>


</form>

