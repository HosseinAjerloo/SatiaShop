<?php

namespace App\Jobs;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\Middleware\WithoutOverlapping;

class SmartCleaningOfTheShoppingCart implements ShouldQueue
{
    use Queueable;

    public $timeout = 0;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->onQueue('CleaningOfTheShoppingCart');
    }

    public function middleware(): array
    {
        return [new WithoutOverlapping('SmartCleaningOfTheShoppingCart')];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $now = Carbon::now();
        $addToCarts = Cart::where('status', 'addToCart')->orWhere('status', 'applyToTheBank')->whereDate('created_at', $now->toDateString())->get();
        if ($addToCarts) {
            foreach ($addToCarts as $cart) {
                if ($cart->cartItem()->count() > 0) {
                    $cartItem = $cart->cartItem()->latest()->first();
                    $cart->status == 'addToCart' ? env('DeleteBasedOnAddCartType') : env('DeleteBasedOnApplyToTheBankType');
                    $lastTime = $now->subMinutes($cart->status == 'addToCart' ? env('DeleteBasedOnAddCartType') : env('DeleteBasedOnApplyToTheBankType'))->toDateTimeString();
                    if ($cartItem->created_at <= $lastTime) {
                        $cart->update(['status' => 'canceledByTheSystem']);
                        $cart->delete();
                    }
                }
            }
        }


    }
}
