<?php

namespace App\Http\Traits;

use App\Models\Reside;
use App\Services\ImageService\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
        $route = Route::current();
        if ($route->getName() == 'admin.sale.generate.factor') {
            $total = $reside->totalPriceSale();

        } else {
            $total = $reside->totalPrice();
        }
        $inputs = request()->all();

        if (isset($inputs['commission']) && $inputs['commission'] == 'yes') {
            $total = ($total * env('Commission') / 100) + $total;
            $inputs['commission'] = env('Commission');
        } else {
            $inputs['commission'] = 0;
        }

        $reside->update([
            'total_price' => $total,
            'discount_collection' => $inputs['discount'],
            'final_price' => $this->calculate($total, $inputs['discount']),
            'description' => $inputs['description'],
            'commission' => $inputs['commission']
        ]);
        if (request()->file('discountFile'))
        {
            $imageService=new ImageService();
            $imageService->setRootFolder('discountFile\\images');
            $path=$imageService->saveImage(request()->file('discountFile'));
            $reside->file()->updateOrCreate([
                'fileable_id'=>$reside->id,
            ],
            [
                'user_id'=>Auth::user()->id,
                'path'=>$path,
            ]);
        }

    }
}
