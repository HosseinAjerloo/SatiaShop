<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'category_id',
        'brand_id',
        'title',
        'description',
        'type',
        'status',
        'price',
        'user_id'
    ];
    const Products=[
        [
            'category_id'=>1,
            'brand_id'=>1,
            'title'=>'samsung a12',
            'type'=>'goods',
            'status'=>'active',
            'price'=>120000000,
            'user_id'=>1

        ],
        [
            'category_id'=>2,
            'brand_id'=>2,
            'title'=>'iphone 16',
            'type'=>'goods',
            'status'=>'active',
            'price'=>1000000000,
            'user_id'=>1
        ],
    ];
    public function image(){
        return $this->morphOne(File::class,'files','fileable_type','fileable_id');
    }
    public function productTransaction(){
        return $this->hasMany(ProductTransaction::class,'product_id','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
    public function cartItem()
    {
        return $this->hasMany(CartItem::class,'product_id');
    }



    public function isRemaining()
    {

        $cart=Cart::where('status','addToCart')->orWhere('status','applyToTheBank')->get();

        $cartItem=CartItem::where('product_id',$this->id)->whereIn('cart_id',$cart->pluck('id'))->get();
        if ($cartItem->count()>0)
        {
            return $cartItem->sum('amount')<$this->productTransaction()->latest()->first()->remain?true:false;
        }

        return true;
    }
    public function productRemaining()
    {
        $cart=Cart::where('status','addToCart')->orWhere('status','applyToTheBank')->get();

        $cartItem=CartItem::where('product_id',$this->id)->whereIn('cart_id',$cart->pluck('id'))->get();
        if ($cartItem->count()>0)
        {
            return $this->productTransaction()->latest()->first()->remain-$cartItem->sum('amount');
        }
            return $this->productTransaction()->latest()->first()->remain;

    }

    public function productExistsInCart():bool
    {
        $user=Auth::user();
        $myCart = Cart::where('status', 'addToCart')->orWhere('user_id', $user ? $user->id : null)->orWhere('user_ip', request()->ip())->first();
        if (!empty($myCart)) {
            $myCartItem = CartItem::where('product_id', $this->id)->whereIn('cart_id', [$myCart->id])->get();
            if ($myCartItem->count() > 0)
                return true;
            return false;
        }
        return false;

    }
}
