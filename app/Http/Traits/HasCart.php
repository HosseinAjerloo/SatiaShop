<?php

namespace App\Http\Traits;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait HasCart
{
    protected function addServiceToCart(Request $request, Cart $cart)
    {
        $product=$request->get('product');
        $cart->cartItem()->create([
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

            $cart->cartItem()->create([
                'product_id' => $product->id,
                'price' => $product->price,
                'amount' => '1',
                'type' => 'product'
            ]);
            return true;
        }
        return false;
    }
    public function checkThe_conditionsOf_TheShopping_cart(Request $request,Cart $myCart){
        $product=$request->get('product');
        if ($product->type == 'service' ) {

            $this->addServiceToCart($request,$myCart);
            $this->updateTotolProceCart($myCart);
            $cartItems=$myCart->cartItem()->get();
            foreach ($cartItems as $item)
            {
                $item->image_path=asset($item->product->image->path);
                $item->title=$item->product->removeUnderLine;
                $item->deleteRoute=route('panel.cart.destroy',$item->id);
            }
            return response()->json(['message' => 'سرویس به سبد خرید شما اضافه شد', 'status' => true,'cartItems'=>$cartItems]);

        } else {
            $result=$this->addProductToCart($request,$myCart);
            $this->updateTotolProceCart($myCart);
            $cartItems=$myCart->cartItem()->get();
            foreach ($cartItems as $item)
            {
                $item->image_path=asset($item->product->image->path);
                $item->title=$item->product->removeUnderLine;
                $item->deleteRoute=route('panel.cart.destroy',$item->id);
            }
            return $result?  response()->json(['message' => 'کالا به سبد خرید شما اضافه شد', 'status' => true,'cartItems'=>$cartItems]):
                response()->json(['message' => 'موجودی محصول انتخابی کافی نیست', 'status' => false,'cartItems'=>$cartItems]) ;
        }
    }
    protected function updateTotolProceCart(Cart $myCart)
    {
        $totalPrice=0;
        foreach ($myCart->cartItem as $cartItem)
        {
            $totalPrice+=$cartItem->product->price*$cartItem->amount;
            $cartItem->update([
                'price'=>$cartItem->product->price
            ]);
        }

        $myCart->update([
            'finalPrice'=>$totalPrice
        ]);
    }

    protected function myCartMerge()
    {
        $user=Auth::user();
        $myCart = Cart::where('status', 'addToCart')->where('user_id', $user->id)->orderBy('id','desc')->get();

        if ($myCart->count())
        {
            $lastCreateCart=$myCart->first();
            $lastCreateCartItem=$lastCreateCart->cartItem;

            $theOtherCarts=$myCart->except($lastCreateCart->id);
            foreach ($theOtherCarts as $theOtherCart)
            {
                if ($theOtherCart->cartItem()->count())
                {
                    foreach ($theOtherCart->cartItem as $cartItem)
                    {
                        if (in_array($cartItem->product_id,$lastCreateCartItem->pluck('product_id')->toArray()))
                        {
                            $item=$lastCreateCartItem->where('product_id',$cartItem->product_id)->first();
                            $item->update(['amount'=>$item->amount+$cartItem->amount]);
                        }
                        else{
                            $lastCreateCart->cartItem()->create($cartItem->toArray());
                        }
                    }
                }
                $theOtherCart->forceDelete();
            }
            $this->updateTotolProceCart($lastCreateCart);

        }

    }
}
