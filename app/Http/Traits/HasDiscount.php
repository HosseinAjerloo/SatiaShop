<?php

namespace App\Http\Traits;

trait HasDiscount
{
    protected function calculate($price, $discount)
    {
        $totalPrice = $price;
        $discount = (($price * $discount) / 100);
        $totalPrice = $totalPrice - $discount;
        return $totalPrice;

    }
}
