<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'brand_id',
        'title',
        'description',
        'type',
        'status',
        'price',
        'user_id'
    ];
    const Products = [
        [
            'category_id' => 1,
            'brand_id' => 1,
            'title' => 'samsung a12',
            'type' => 'goods',
            'status' => 'active',
            'price' => 120000000,
            'user_id' => 1

        ],
        [
            'category_id' => 2,
            'brand_id' => 2,
            'title' => 'iphone 16',
            'type' => 'goods',
            'status' => 'active',
            'price' => 1000000000,
            'user_id' => 1
        ],
    ];
    public function scopeSearch(Builder $query): void
    {

        $query->when(request()->input('date'),function ($query){
            $query->whereDate('created_at',">=",Carbon::now()->subMonths(request()->input('date'))->toDateString());
        })->when(request()->input('name'),function ($query){
            $query->where('title','like',"%".request()->input('name')."%");
        })->when(request()->input('customDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('customDate')));
            $query->whereDate('created_at',">=",$date);
        });
    }

    protected function title():Attribute
    {

        return Attribute::make(

            set: fn($value)=>preg_replace("/(\s){1,}/imu",'-',$value)
        );
    }

    protected function removeUnderLine():Attribute
    {
        return Attribute::make(
            get: fn()=>str_replace('-',' ',$this->title)
        );
    }
    public function image()
    {
        return $this->morphOne(File::class, 'files', 'fileable_type', 'fileable_id');
    }

    public function productTransaction()
    {
        return $this->hasMany(ProductTransaction::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function cartItem()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }


    public function isRemaining()
    {
        $cart = Cart::where('status', 'addToCart')->orWhere('status', 'applyToTheBank')->get();

        $cartItem = CartItem::where('product_id', $this->id)->whereIn('cart_id', $cart->pluck('id'))->get();

        if ($cartItem->count() > 0) {
            if ($this->type == 'goods')
                return $cartItem->sum('amount') < $this->productTransaction()->latest()->first()->remain ? true : false;


        }
        if ($this->productRemaining()){
            return true;
        }
        else{
           return false;
        }

    }

    public function productRemaining()
    {

        $cart = Cart::where('status', 'addToCart')->orWhere('status', 'applyToTheBank')->get();
        $cartItem = CartItem::where('product_id', $this->id)->whereIn('cart_id', $cart->pluck('id'))->get();
        if ($cartItem->count() > 0) {
            if ($this->type == 'goods')
            {
                $total=($this->productTransaction()->latest()->first()->remain??0) - $cartItem->sum('amount');
                return  $total>0?$total:0;
            }
            else{
                return 'نامحدود';
            }
        }
        if ($this->type == 'goods')
            return $this->productTransaction()->latest()->first()->remain??0;
        else
            return 'نامحدود';
    }

    public function productRemainingExceptUser($user, $productCount)
    {
        $cart = Cart::where(fn($q) => $q->whereNull('user_id')->orWhere('user_id', "!=", $user->id))->whereIn('status', ['addToCart', 'applyToTheBank'])->get();
        $cartItem = CartItem::where('product_id', $this->id)->whereIn('cart_id', $cart->pluck('id'))->get();
        if ($cartItem->count() > 0) {
            if ($this->type == 'goods') {
                $remainProduct = $this->productTransaction()->latest()->first()->remain - $cartItem->sum('amount');
                return ($remainProduct >= $productCount) ? true : false;
            } else {
                return true;
            }
        }
        if ($this->type == 'goods') {
            $remainProduct = $this->productTransaction()->latest()->first()->remain;
            return ($remainProduct >= $productCount) ? true : false;
        } else {
            return true;
        }

    }

    public function productExistsInCart(): bool
    {
        $user = Auth::user();

        $myCart = Cart::where('status', 'addToCart')->when($user,function ($query) use ($user) {
            $query->where('user_id',  $user->id);
        })->when(!$user,function ($query){
            $query->where('id', session()->get('cart_id'));
        })->first();

        if (!empty($myCart)) {
            $myCartItem = CartItem::where('product_id', $this->id)->whereIn('cart_id', [$myCart->id])->get();
            if ($myCartItem->count() > 0)
                return true;
            return false;
        }
        return false;

    }
    public function  getTypePersian():Attribute{
        return  Attribute::make(
          get: fn()=>$this->type=='goods'?'کالا' :'سرویس'
        );
    }

}
