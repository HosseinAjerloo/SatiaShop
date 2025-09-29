<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasCart;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use HasCart;

    public function index(Request $request)
    {
        $user = Auth::user();
        $myCart = Cart::where('status', 'addToCart')->orWhere('status','applyToTheBank')->when($user,function ($query) use ($user) {
            $query->where('user_id',  $user->id);
        })->when(!$user,function ($query){
            $query->where('id', session()->get('cart_id'));
        })->first();

        if (!$myCart)
            return redirect()->route('panel.index')->withErrors(['error'=>'سبد خرید شما خالی است لطفا کالایی را انتخاب کنید']);
        $breadcrumbs=Breadcrumbs::render('panel.cart.index')->getData()['breadcrumbs'];

        return view('Panel.cart', compact('myCart','breadcrumbs'));
    }

    public function addCart(Request $request)
    {
        $user = Auth::user();
        $inputs = $request->all();
        $product = Product::find($inputs['product_id']);
        if (!$product)
            return response()->json(['message' => 'موردی یافت نشد لطفا شبکه خود را چک کنید', 'status' => false]);


        $request->request->add(['product' => $product]);

        $myCart = Cart::where('status', 'addToCart')->orWhere('status','applyToTheBank')->when($user,function ($query) use ($user) {
            $query->where('user_id',  $user->id);
        })->when(!$user,function ($query){
            $query->where('id', session()->get('cart_id'));
        })->first();

        if (!empty($myCart)) {
            $myCartItem = CartItem::where('product_id', $product->id)->whereIn('cart_id', [$myCart->id])->get();
            $cartItems=$myCart->cartItem()->get();
            foreach ($cartItems as $item)
            {
                $item->image_path=asset($item->product->image->path);
                $item->title=$item->product->removeUnderLine;
                $item->deleteRoute=route('panel.cart.destroy',$item->id);
            }
            if ($myCartItem->count() > 0)
                return response()->json(['message' => 'این مورد قبلا به سبد خرید شما اضافه شده است', 'status' => false,'cartItems'=>$cartItems]);

            return $this->checkThe_conditionsOf_TheShopping_cart($request, $myCart);

        } else {
            $myCart = Cart::create([
                'user_id' => $user ? $user->id : null,
                'user_ip' => $request->ip(),
                'finalPrice' => null
            ]);
            session(['cart_id'=>$myCart->id]);
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

        $myCart = Cart::where('status', 'addToCart')->orWhere('status','applyToTheBank')->when($user,function ($query) use ($user) {
            $query->where('user_id',  $user->id);
        })->when(!$user,function ($query){
            $query->where('id', session()->get('cart_id'));
        })->first();


        if ($product->isRemaining()) {
            $result = $myCart->cartItem()->where('product_id', $product->id)->update([
                'amount' => $request->amount
            ]);
            $this->updateTotolProceCart($myCart);

            return response()->json(['maxAmount' => $request->amount, 'status' => true]);

        } else {
            return response()->json(['message' => 'موجودی کافی نیست', 'status' => false, 'maxAmount' => $product->productRemaining()]);

        }

    }

    public function decrease(Request $request)
    {
        $user = Auth::user();
        $inputs = $request->all();
        $product = Product::find($inputs['product_id']);
        if (!$product or !$request->has('amount'))
            return response()->json(['message' => 'موردی یافت نشد لطفا شبکه خود را چک کنید', 'status' => false]);


        $myCart = Cart::where('status', 'addToCart')->orWhere('status','applyToTheBank')->when($user,function ($query) use ($user) {
            $query->where('user_id',  $user->id);
        })->when(!$user,function ($query){
            $query->where('id', session()->get('cart_id'));
        })->first();

        if ($request->amount >= 1) {
            $result = $myCart->cartItem()->where('product_id', $product->id)->update([
                'amount' => $request->amount
            ]);
            $this->updateTotolProceCart($myCart);

            return response()->json(['maxAmount' => $request->amount, 'status' => true]);

        } else {
            return response()->json(['message' => 'تعداد محصول نمیتواند از یک کوچک تر باشد', 'status' => false, 'maxAmount' => $product->productRemaining()]);

        }
    }
    public function destroy(CartItem $cartItem,Request $request)
    {
        $user = Auth::user();

        $myCart = Cart::where('status', 'addToCart')->orWhere('status','applyToTheBank')->when($user,function ($query) use ($user) {
            $query->where('user_id',  $user->id);
        })->when(!$user,function ($query){
            $query->where('id', session()->get('cart_id'));
        })->first();

        $cartItem->delete();
        $this->updateTotolProceCart($myCart);

        if ($myCart->cartItem()->count()>0)
        {
            return redirect()->route('panel.cart.index')->with('success','محصول شما از سبد خرید حذف شد');
        }
        return redirect()->route('panel.index')->with('success','محصول شما از سبد خرید حذف شد');

    }
    public function getCountNumberOfCartItem()
    {
        $user=Auth::user();
        $myCart = Cart::where('status', 'addToCart')->orWhere('status','applyToTheBank')->when($user,function ($query) use ($user) {
            $query->where('user_id',  $user->id);
        })->when(!$user,function ($query){
            $query->where('id', session()->get('cart_id'));
        })->first();

        if ($myCart)
            return response()->json(['status'=>true,'countItem'=>$myCart->cartItem]);

        return response()->json(['status'=>false]);

    }
}
