<?php

namespace App\Jobs;

use App\Models\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\Middleware\WithoutOverlapping;

class SmartCleaningOfTheShoppingCart implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->onQueue('CleaningOfTheShoppingCart');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $carts = Cart::where('status', 'addToCart')->orWhere('status', 'applyToTheBank')->get();
        if ($carts) {
            foreach ($carts as $cart) {
                if ($cart->cartItem()->count() > 0) {
                    $cartItem = $cart->cartItem()->latest()->first();
                    $lastTime = \Illuminate\Support\Carbon::now()->subMinutes(10)->toDateTimeString();
                    if ($cartItem->created_at <= $lastTime) {
                        $cart->update(['status' => 'canceledByTheSystem']);
                    }
                }
            }
        }
    }
}
