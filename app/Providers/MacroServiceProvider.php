<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Illuminate\Database\Eloquent\Builder;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Builder::macro('whereLike',function ($attributes,$value=''){
          return  $this->where(function ($qu) use ($attributes,$value){
             foreach ($attributes as $attribute)
             {
                    $qu->orWhere($attribute,'like',"%$value%");
             }
          });
        });
    }
}
