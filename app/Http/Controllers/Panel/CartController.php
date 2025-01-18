<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasCart;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use HasCart;

    public function index(Request $request)
    {
        $user = Auth::user();
        $myCart = Cart::where('status', 'addToCart')->orWhere('user_id', $user ? $user->id : null)->orWhere('user_ip', $request->ip())->first();
        return view('Site.cart', compact('myCart'));
    }

    public function addCart(Request $request)
    {
        $user = Auth::user();
        $inputs = $request->all();
        $product = Product::find($inputs['product_id']);
        if (!$product)
            return response()->json(['message' => 'موردی یافت نشد لطفا شبکه خود را چک کنید', 'status' => false]);


        $request->request->add(['product' => $product]);

        $myCart = Cart::where('status', 'addToCart')->orWhere('user_id', $user ? $user->id : null)->orWhere('user_ip', $request->ip())->first();
        if (!empty($myCart)) {
            $myCartItem = CartItem::where('product_id', $product->id)->whereIn('cart_id', [$myCart->id])->get();
            if ($myCartItem->count() > 0)
                return response()->json(['message' => 'این مورد قبلا در سبد خرید شما اضافه شده است', 'status' => false]);

            return $this->checkThe_conditionsOf_TheShopping_cart($request, $myCart);

        } else {
            $myCart = Cart::create([
                'user_id' => $user ? $user->id : null,
                'user_ip' => $request->ip(),
                'finalPrice' => null
            ]);
            return $this->checkThe_conditionsOf_TheShopping_cart($request, $myCart);
        }

    }

    public function increase(Request $request)
    {
        $user = Auth::user();
        $inputs = $request->all();
        $product = Product::find($inputs['product_id']);

        if (!$product or !$request->has('amount'))
            return response()->json(['message' => 'موردی یافت نشد لطفا شبکه خود را چک کنید', 'status' => false]);

        $myCart = Cart::where('status', 'addToCart')->orWhere('user_id', $user ? $user->id : null)->orWhere('user_ip', $request->ip())->first();

        if ($request->amount <= $product->productRemaining()) {
            $result = $myCart->cartItem()->where('product_id', $product->id)->update([
                'amount' => $request->amount
            ]);
            return response()->json(['maxAmount'=>$product->productRemaining(),'status'=>true]);

        } else {
            return response()->json(['message' => 'موجودی کافی نیست', 'status' => false,'maxAmount'=>$product->productRemaining()]);

        }

    }
}
