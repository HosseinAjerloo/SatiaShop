<?php

namespace App\Http\Traits;

trait HasProduct
{
    protected function separationOfArraysFromText($value)
    {
        $value = array_filter($value, function ($item) use ($value) {
            if (is_array($item)) {
                return $item;
            }
        });
        return $value;
    }

    protected function arrayCountValidation($productItems)
    {
        $productCounts = count($productItems['product_id']);
        foreach ($productItems as $item) {
            if ($productCounts != count($item))
                return false;
        }
       return true;
    }

    protected function lang($itemKeyLang)
    {
        $persian=[
            'price'=>'قیمت محصول',
            'amount'=>'تعداد محصول ',
            'product_id'=>'محصول ',
            'description'=>'توضیحات محصول '
        ];
        foreach ($itemKeyLang as $key=> $item)
        {
            $item=str_replace($item,$persian[explode('.',$item)[0]].'.'.explode('.',$item)[1],$item);
            $itemKeyLang[$key]=$item;
        }
        return $itemKeyLang;

    }
}
