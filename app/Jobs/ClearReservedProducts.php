<?php

namespace App\Jobs;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ClearReservedProducts implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->onQueue('ClearReservedProducts');
    }
    public function uniqueId(): string
    {
        return 'clearReservedProductsKey';
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $carts = Cart::where('status', 'addToCart')?->get();
        if ($carts->count()) {
            $carts->map(function ($cart) {
                $cartItem = $cart->cartItem()->latest()->first();
                if ($cartItem) {
                    $subtime = Carbon::now()->subMinutes(env('DeleteBasedOnAddCartType'))->toDateTimeString();
                    if ($cartItem->created_at < $subtime){
                        $cart->cartItem->map(function ($item){
                            $item->delete();
                        });
                        $cart->update(['status' => "canceledByTheSystem"]);


                    }
                }
            });
        }
    }
}
