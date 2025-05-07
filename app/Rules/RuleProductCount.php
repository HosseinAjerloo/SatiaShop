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
        if ($route->getName() == 'admin.invoice.issuance.store') {
            $productValue = [];
            foreach ($value as $product) {
                $productValue[$product] = 1;
            }
            $value = $productValue;
        }

        $user = Auth::user();
        foreach ($value as $productID => $productCount) {
            $product = Product::find($productID);
            if (!$product->isRemaining()) {
                $fail(" تعداد کافی از محصول " . $product->removeUnderLine . " موجود نمیباشد لطفا از سفارش خود را ویرایش کنید ");
            }
        }
    }
}
