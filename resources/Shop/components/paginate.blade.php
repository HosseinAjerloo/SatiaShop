<section class="page min-w-full flex justify-end items-center space-x-reverse space-x-4 px-2 flex-wrap">
    <div>
        <p>مجموع <span class="font-bold text-sm">{{$items->total()??0}}</span> مورد</p>
    </div>
    <div>
        <ul class="flex items-center justify-center space-x-reverse space-x-4 font-bold text-sm">
            <li>

                <a href="@if($items->currentPage()>1) {{$items->url($items->currentPage()-1)}} @endif">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            </li>
            @if($items->hasPages() and ($items->lastPage() - $items->currentPage()) > 3 )
                @for($i=$items->currentPage();$i< $items->currentPage()+3;$i++)
                    <a href="{{$items->url($i)}}">
                        <li class="@if($i==$items->currentPage()) activePage @endif">{{$i}}</li>
                    </a>
                @endfor
                <li>...</li>
                <a href="{{$items->url($items->lastPage())}}">
                    <li>{{$items->lastPage()}}</li>
                </a>

            @else
                                @for($i=1;$i<$items->lastPage()+1;$i++)

                                    <a href="{{$items->url($i)}}">
                                        <li class="@if($i==$items->currentPage()) activePage @endif">{{$i}}</li>
                                    </a>
                                @endfor

            @endif

            <li>
                <a href="@if($items->currentPage()<$items->lastPage()) {{$items->url($items->currentPage()+1)}} @endif">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
            </li>
        </ul>
    </div>

</section>
