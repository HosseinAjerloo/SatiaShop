<section class=" py-2 flex  items-center flex-wrap ">

    @foreach($breadcrumbs as $breadcrumb)
        <a href="{{$breadcrumb->url}}" {{$attributes}}>
                {{$breadcrumb->title}}
        </a>
    @endforeach

</section>
