<?php

namespace App\Http\Traits;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

trait HasCart
{
    protected function addServiceToCart(Request $request, Cart $cart)
    {
        $product=$request->get('product');
        $cart->CartItem()->create([
            'product_id' => $product->id,
            'price' => $product->price,
            'amount' => 1,
            'type' => 'service'
        ]);
    }

    protected function addProductToCart(Request $request, Cart $cart)
    {
        $product=$request->get('product');

        if ($product->isRemaining()) {
            $cart->CartItem()->create([
                'product_id' => $product->id,
                'price' => $product->price,
                'amount' => 'product',
                'type' => 'service'
            ]);
            return true;
        }
        return false;
    }
    public function checkThe_conditionsOf_TheShopping_cart(Request $request,Cart $myCart){
        $product=$request->get('product');

        if ($product->type == 'service' ) {

            $this->addServiceToCart($request,$myCart);
            return response()->json(['message' => 'سرویس به سبد خرید شما اضافه شد', 'status' => true]);

        } else {
            $result=$this->addProductToCart($request,$myCart);
            return $result?  response()->json(['message' => 'کالا به سبد خرید شما اضافه شد', 'status' => true]):
                response()->json(['message' => 'موجودی محصول انتخابی کافی نیست', 'status' => false]) ;
        }
    }
}
