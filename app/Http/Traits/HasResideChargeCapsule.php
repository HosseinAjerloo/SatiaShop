<?php
namespace App\Http\Traits;

use App\Models\Product;

trait  HasResideChargeCapsule{
    protected $resideItems=array();
        protected function getResideCapsuleItem():bool
        {
            $inputs=request()->all();
            if (count($inputs['product_description'])!=count($inputs['product_status']))
            {
                return false;
            }
            foreach ($inputs['product_description'] as $key=>$value)
            {
                if (!isset($inputs['product_status'][$key]))
                    return false;

                    if (str_contains($key,"_"))
                        $key=explode('_',$key)[0];
                    $product=Product::find($key);
                    $resideItem=[
                        'product_id'=>$key,
                        'price'=>$product->price??0,
                        'type'=>$product->type,
                        'status'=>$inputs['product_status'][$key],
                        'description'=>$value
                    ];
                    array_push($this->resideItems,$resideItem);
            }
            if (empty($this->resideItems))
                return false;
            return true;
        }


}
