<section class=" py-2 flex  items-center flex-wrap">
    @foreach($breadcrumbs as $breadcrumb)
        <a href="{{$breadcrumb->url}}" class="px-4 h-[30px] text-min_sm text-center  breadcrumb flex items-center justify-center text-white">
            {{$breadcrumb->title}}
        </a>

    @endforeach

</section>
