<?php

namespace App\View\Components\capsules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GasCo2 extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $reside,public $resideItem,public $categories )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.capsules.gas-co2');
    }
}
