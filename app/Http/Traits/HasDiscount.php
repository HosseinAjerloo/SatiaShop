<?php

namespace App\Http\Traits;

use App\Models\Reside;

trait HasDiscount
{
    protected function calculate($price, $discount)
    {
        $totalPrice = $price;
        $discount = (($price * $discount) / 100);
        $totalPrice = $totalPrice - $discount;
        return $totalPrice;
    }

    protected function compilationResideFactor(Reside $reside)
    {
        $total = 0;
        $resideItem = $reside->resideItem;
        $inputs = request()->all();
        foreach ($resideItem as $item) {
            $total += $item->getTotalProductPriceItems();
        }
        $reside->update([
            'total_price' => $total,
            'discount_collection' => $inputs['discount'],
            'final_price' => $this->calculate($total, $inputs['discount']),
            'description'=>$inputs['description']
        ]);
    }
}
