<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ResidChargeCapsuleProductStatus implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!empty(request()->input('product_description')))
        {
            foreach (request()->input('product_description') as $key=>$item)
            {
                if (!array_key_exists($key,$value))
                {
                    $value[$key]=null;
                }
            }
        }
        foreach ($value as $key => $item){
            $key=explode('_',$key)[0];

            $product=$this->hasProduct($key);
            if ($product){
                    if (!($item=='recharge' or $item=='used'))
                    {
                        $fail($product->removeUnderLine.' وضعیت آن به درستی انتخاب نشده است ');
                    }
            }else{
                $fail('محصول انتخابی مورد تایید نمیباشد.');
            }

        }
    }

    private function hasProduct($id) {
        $product=Product::find($id);
        return $product ? $product:false;
    }
}
