<section class="min-w-full flex justify-center items-center space-x-reverse space-x-2 px-2 flex-wrap">

    @if($items->currentPage()>1)

        @for($j=$items->currentPage()-5;$j<$items->currentPage();$j++)
            @if($j!=$items->currentPage() and $j>0)
                <a href="{{$items->url($j)}}"
                   class="w-8 h-8 rounded-sm  flex items-center justify-center font-bold shadow shadow-2081F2 mt-5 @if($items->currentPage()==$j) @endif">
                    {{$j}}
                </a>
            @endif

        @endfor
        <div
            class="w-8 h-8 rounded-sm  flex items-center justify-center font-bold shadow shadow-2081F2 mt-5">
            ...
        </div>
    @endif
    @if($items->hasPages())
        @for($i=$items->currentPage();$i<$items->currentPage()+3;$i++)

            @if($items->lastPage()>=$i)
                <a href="{{$items->url($i)}}"
                   class="w-8 h-8 rounded-sm  flex items-center justify-center font-bold shadow shadow-2081F2 mt-5 @if($items->currentPage()==$i)selectPage @endif">
                    {{$i}}
                </a>
            @endif

        @endfor
    @endif
    @if($items->hasMorePages() )
        <div
            class="w-8 h-8 rounded-sm  flex items-center justify-center font-bold shadow shadow-2081F2 mt-5">
            ...
        </div>
    @endif

    @if($items->hasMorePages() and $items->currentPage()>=3)
        @for($i=$items->currentPage()+4;$i<$items->currentPage()+6;$i++)
            @if($items->lastPage()>=$i)
                <a href="{{$items->url($i)}}"
                   class="w-8 h-8 rounded-sm  flex items-center justify-center font-bold shadow shadow-2081F2 mt-5 @if($items->currentPage()==$i)selectPage @endif">
                    {{$i}}
                </a>
            @endif
        @endfor
    @endif




</section>
