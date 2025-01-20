<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class RuleProductCount implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user=Auth::user();
       foreach ($value as $productID=> $productCount)
       {
           $product=Product::find($productID);

           if ( !$product->productRemainingExceptUser($user,$productCount))
           {
               $fail( "تعداد کافی از محصول".$product->title." موجود نمیباشد لطفا از سبد خرید خود پاک فرمایید");
           }

       }
    }
}
