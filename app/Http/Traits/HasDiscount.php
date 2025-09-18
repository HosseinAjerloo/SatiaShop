<?php

namespace App\Http\Traits;

use App\Models\Reside;
use App\Services\ImageService\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

trait HasDiscount
{
    protected function calculateDecimal($price, $discount)
    {
        $totalPrice = $price;
        $discount = (($price * $discount) / 100);
        $totalPrice = $totalPrice - $discount;
        return $totalPrice;
    }
    protected function calculatePrice($price, $discount)
    {
        $totalPrice = $price;
        $totalPrice= $totalPrice -$discount;
        return $totalPrice;
    }

    protected function compilationResideFactor(Reside $reside)
    {
        $route = Route::current();
        $totalPrice=0;
        if ($route->getName() == 'admin.sale.generate.factor') {
            $total = $reside->totalPriceSale();

        } else {
            $total = $reside->totalPrice();
        }
        $inputs = request()->all();


        if (isset($inputs['discountDecimal']))
        {
            $totalPrice=$this->calculateDecimal($total,$inputs['discountDecimal']);
        }
        elseif (isset($inputs['discount_price']))
        {
            $totalPrice=$this->calculatePrice($total,$inputs['discount_price']);
        }
        else{
            $totalPrice=$total;
        }

        if (isset($inputs['commission']) && $inputs['commission'] == 'yes') {
            $totalPrice = ($totalPrice * env('Commission') / 100) + $totalPrice;
            $inputs['commission'] = env('Commission');
        } else {
            $inputs['commission'] = 0;
        }

        $reside->update([
            'total_price' => $total,
            'discount_collection' => $inputs['discountDecimal'],
            'final_price' => $totalPrice,
            'discount_price' => $inputs['discount_price'],
            'description' => $inputs['description'],
            'commission' => $inputs['commission']
        ]);
        if (request()->file('discountFile'))
        {
            $filesPath=[];
            $imageService=new ImageService();
            $imageService->setRootFolder("discountFile".DIRECTORY_SEPARATOR."images");
            $filesPath=$imageService->saveImageMany(request()->file('discountFile'));
            if (!empty($filesPath))
            {
                $file=[];
                foreach ($filesPath as $filePath)
                {
                    array_push($file,["user_id"=>Auth::user()->id,'path'=>$filePath]);
                }
                $reside->file()->forceDelete();
                $reside->file()->createMany($file);

            }else{
                throw new \Exception('Saved photo encountered interference.');
            }

        }

    }
}
