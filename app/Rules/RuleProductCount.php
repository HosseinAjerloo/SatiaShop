<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RuleProductCount implements ValidationRule
{
    private $message;

    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $route = Route::current();
        if ($route->getName() == 'admin.invoice.issuance.storeProductItem') {
//            dd($value);
            $productValue = [];
            foreach ($value as $key=> $product) {
                if (str_contains($key,'id_'))
                {
                    $id=explode('_',$key)[1];
                    $productValue[$id]=$product;
                }
                else{
                    $productValue[$product] = 1;
                }
            }
            $value = $productValue;
        }


        foreach ($value as $productID => $productCount) {
            $product = Product::find($productID);
            if (!$product->productRemainingExceptUser($productCount)) {
                $fail(" تعداد کافی از محصول " . $product->removeUnderLine . " موجود نمیباشد لطفا از سفارش خود را ویرایش کنید ");
            }
        }
    }
}
