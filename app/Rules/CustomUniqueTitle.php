<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CustomUniqueTitle implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value=preg_replace("/(\s){1,}/imu",'-',$value);
        $product=Product::where('title',$value)->get();
        if ($product->count()>1)
         $product?$fail('عنوان این محصول قبلا ذخیره شده است لطفا عنوان محصول را تغییر دهید'):'';

    }
}
