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

    protected $appends = ['is_favorite'];

    const Products = [
        [
            'category_id' => 1,
            'brand_id' => 2,
            'title' => 'کپسول پودر و گاز یک کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 10000000,
            'user_id' => 1
        ],
        [
            'category_id' => 1,
            'brand_id' => 1,
            'title' => 'کپسول پودر و گاز دو کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 15000000,
            'user_id' => 1
        ],
        [
            'category_id' => 1,
            'brand_id' => 1,
            'title' => 'کپسول پودر و گاز سه کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 20000000,
            'user_id' => 1
        ],
        [
            'category_id' => 1,
            'brand_id' => 1,
            'title' => 'کپسول پودر و گاز چهار کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 23000000,
            'user_id' => 1
        ],
        [
            'category_id' => 1,
            'brand_id' => 1,
            'title' => 'کپسول پودر و گاز شش کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 28000000,
            'user_id' => 1
        ],
        [
            'category_id' => 1,
            'brand_id' => 1,
            'title' => 'کپسول پودر و گاز دوازده کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 38000000,
            'user_id' => 1
        ],
        [
            'category_id' => 1,
            'brand_id' => 1,
            'title' => 'کپسول پودر و گاز بیست و پنج کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 68000000,
            'user_id' => 1
        ],
        [
            'category_id' => 1,
            'brand_id' => 1,
            'title' => 'کپسول پودر و گاز پنجاه کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 100000000,
            'user_id' => 1
        ],
        [
            'category_id' => 2,
            'brand_id' => 2,
            'title' => 'کپسول پودر و گاز شش کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 14000000,
            'user_id' => 1
        ],
        [
            'category_id' => 2,
            'brand_id' => 2,
            'title' => 'کپسول پودر و گاز دوازده کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 22000000,
            'user_id' => 1
        ],
        [
            'category_id' => 2,
            'brand_id' => 2,
            'title' => 'کپسول پودر و گاز پنجاه کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 52000000,
            'user_id' => 1
        ],

        [
            'category_id' => 3,
            'brand_id' => 2,
            'title' => 'کپسول گاز co2 دو کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 12000000,
            'user_id' => 1
        ],

        [
            'category_id' => 3,
            'brand_id' => 2,
            'title' => 'کپسول گاز co2 سه کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 14000000,
            'user_id' => 1
        ],
        [
            'category_id' => 3,
            'brand_id' => 3,
            'title' => 'کپسول گاز co2 چهار کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 16000000,
            'user_id' => 1
        ],
        [
            'category_id' => 3,
            'brand_id' => 3,
            'title' => 'کپسول گاز co2 شش کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 18000000,
            'user_id' => 1
        ],
        [
            'category_id' => 3,
            'brand_id' => 3,
            'title' => 'کپسول گاز co2 نه کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 20000000,
            'user_id' => 1
        ],
        [
            'category_id' => 3,
            'brand_id' => 3,
            'title' => 'کپسول گاز co2 دوازده کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 26000000,
            'user_id' => 1
        ],
        [
            'category_id' => 3,
            'brand_id' => 3,
            'title' => 'کپسول گاز co2 بیست کیلوئی',
            'type' => 'goods',
            'status' => 'active',
            'price' => 30000000,
            'user_id' => 1
        ],

        ///

        [
            'category_id' => 5,
            'brand_id' => 3,
            'title' => 'پودر مصرفی یک کیلوئی',
            'type' => 'service',
            'status' => 'active',
            'price' => 10000000,
            'user_id' => 1
        ],
        [
            'category_id' => 5,
            'brand_id' => 3,
            'title' => 'پودر مصرفی دو کیلوئی',
            'type' => 'service',
            'status' => 'active',
            'price' => 20000000,
            'user_id' => 1
        ],
        [
            'category_id' => 5,
            'brand_id' => 3,
            'title' => 'پودر مصرفی سه کیلوئی',
            'type' => 'service',
            'status' => 'active',
            'price' => 30000000,
            'user_id' => 1
        ],
        [
            'category_id' => 5,
            'brand_id' => 3,
            'title' => 'پودر مصرفی چهار کیلوئی',
            'type' => 'service',
            'status' => 'active',
            'price' => 40000000,
            'user_id' => 1
        ],
        [
            'category_id' => 5,
            'brand_id' => 3,
            'title' => 'پودر مصرفی شش کیلوئی',
            'type' => 'service',
            'status' => 'active',
            'price' => 60000000,
            'user_id' => 1
        ],
        [
            'category_id' => 5,
            'brand_id' => 3,
            'title' => 'پودر مصرفی دوازده کیلوئی',
            'type' => 'service',
            'status' => 'active',
            'price' => 65000000,
            'user_id' => 1
        ],
        [
            'category_id' => 5,
            'brand_id' => 3,
            'title' => 'پودر مصرفی بیست و پنج کیلوئی',
            'type' => 'service',
            'status' => 'active',
            'price' => 75000000,
            'user_id' => 1
        ],
        [
            'category_id' => 5,
            'brand_id' => 3,
            'title' => 'پودر مصرفی پنجاه کیلوئی',
            'type' => 'service',
            'status' => 'active',
            'price' => 80000000,
            'user_id' => 1
        ],
        ///
        [
            'category_id' => 4,
            'brand_id' => 3,
            'title' => 'حجم گاز یک کیلوئی پودرو گاز',
            'type' => 'service',
            'status' => 'active',
            'price' => 10000000,
            'user_id' => 1
        ],
        [
            'category_id' => 4,
            'brand_id' => 3,
            'title' => 'حجم گاز دو کیلوئی پودرو گاز',
            'type' => 'service',
            'status' => 'active',
            'price' => 20000000,
            'user_id' => 1
        ],
        [
            'category_id' => 4,
            'brand_id' => 3,
            'title' => 'حجم گاز سه کیلوئی پودرو گاز',
            'type' => 'service',
            'status' => 'active',
            'price' => 30000000,
            'user_id' => 1
        ],
        [
            'category_id' => 4,
            'brand_id' => 3,
            'title' => 'حجم گاز چهار کیلوئی پودرو گاز',
            'type' => 'service',
            'status' => 'active',
            'price' => 40000000,
            'user_id' => 1
        ],
        [
            'category_id' => 4,
            'brand_id' => 3,
            'title' => 'حجم گاز شش کیلوئی پودرو گاز',
            'type' => 'service',
            'status' => 'active',
            'price' => 60000000,
            'user_id' => 1
        ],
        [
            'category_id' => 4,
            'brand_id' => 3,
            'title' => 'حجم گاز دوازده کیلوئی پودرو گاز',
            'type' => 'service',
            'status' => 'active',
            'price' => 65000000,
            'user_id' => 1
        ],
        [
            'category_id' => 4,
            'brand_id' => 3,
            'title' => 'حجم گاز بیست و پنج کیلوئی پودرو گاز',
            'type' => 'service',
            'status' => 'active',
            'price' => 75000000,
            'user_id' => 1
        ],
        [
            'category_id' => 4,
            'brand_id' => 3,
            'title' => 'حجم گاز پنجاه کیلوئی پودرو گاز',
            'type' => 'service',
            'status' => 'active',
            'price' => 80000000,
            'user_id' => 1
        ],
        ///
        [
            'category_id' => 1,
            'brand_id' => 3,
            'title' => 'شیر کامل پودر و گاز',
            'type' => 'goods',
            'status' => 'active',
            'price' => 80000000,
            'user_id' => 1
        ],
        [
            'category_id' => 1,
            'brand_id' => 3,
            'title' => 'مانومتر پودر و گاز',
            'type' => 'goods',
            'status' => 'active',
            'price' => 6000000,
            'user_id' => 1
        ],
        [
            'category_id' => 1,
            'brand_id' => 3,
            'title' => 'شیلنگ اطفاع پودر و گاز',
            'type' => 'goods',
            'status' => 'active',
            'price' => 8000000,
            'user_id' => 1
        ],
        [
            'category_id' => 1,
            'brand_id' => 3,
            'title' => 'میر آب  پودر و گاز',
            'type' => 'goods',
            'status' => 'active',
            'price' => 10000000,
            'user_id' => 1
        ],
        ///
        [
            'category_id' => 6,
            'brand_id' => 2,
            'title' => 'مایع کف یک کیلوئی',
            'type' => 'service',
            'status' => 'active',
            'price' => 5000000,
            'user_id' => 1
        ],
        [
            'category_id' => 6,
            'brand_id' => 2,
            'title' => 'مایع کف دو کیلوئی',
            'type' => 'service',
            'status' => 'active',
            'price' => 7000000,
            'user_id' => 1
        ],
        [
            'category_id' => 6,
            'brand_id' => 2,
            'title' => 'مایع کف سه کیلوئی',
            'type' => 'service',
            'status' => 'active',
            'price' => 9000000,
            'user_id' => 1
        ],
        [
            'category_id' => 2,
            'brand_id' => 2,
            'title' => 'مانومتر آب و کف',
            'type' => 'goods',
            'status' => 'active',
            'price' => 7000000,
            'user_id' => 1
        ],
        [
            'category_id' => 2,
            'brand_id' => 2,
            'title' => 'شیلنگ اطفاع آب و کف',
            'type' => 'goods',
            'status' => 'active',
            'price' => 7000000,
            'user_id' => 1
        ],
        [
            'category_id' => 2,
            'brand_id' => 2,
            'title' => 'تعویض شیر کامل آب و کف',
            'type' => 'goods',
            'status' => 'active',
            'price' => 7000000,
            'user_id' => 1
        ],

        [
            'category_id' => 2,
            'brand_id' => 2,
            'title' => 'تعویض شیر کامل آب و کف',
            'type' => 'goods',
            'status' => 'active',
            'price' => 7000000,
            'user_id' => 1
        ],
        ///
        [
            'category_id' => 7,
            'brand_id' => 3,
            'title' => 'حجم گاز یک کیلوئی CO2',
            'type' => 'service',
            'status' => 'active',
            'price' => 10000000,
            'user_id' => 1
        ],
        [
            'category_id' => 7,
            'brand_id' => 3,
            'title' => 'حجم گاز دو کیلوئی CO2',
            'type' => 'service',
            'status' => 'active',
            'price' => 20000000,
            'user_id' => 1
        ],
        [
            'category_id' => 7,
            'brand_id' => 3,
            'title' => 'حجم گاز سه کیلوئی CO2',
            'type' => 'service',
            'status' => 'active',
            'price' => 30000000,
            'user_id' => 1
        ],
        [
            'category_id' => 7,
            'brand_id' => 3,
            'title' => 'حجم گاز چهار کیلوئی CO2',
            'type' => 'service',
            'status' => 'active',
            'price' => 40000000,
            'user_id' => 1
        ],
        [
            'category_id' => 4,
            'brand_id' => 3,
            'title' => 'حجم گاز شش کیلوئی CO2',
            'type' => 'service',
            'status' => 'active',
            'price' => 60000000,
            'user_id' => 1
        ],
        [
            'category_id' => 4,
            'brand_id' => 3,
            'title' => 'حجم گاز دوازده کیلوئی CO2',
            'type' => 'service',
            'status' => 'active',
            'price' => 65000000,
            'user_id' => 1
        ],
        [
            'category_id' => 4,
            'brand_id' => 3,
            'title' => 'حجم گاز بیست و پنج کیلوئی CO2',
            'type' => 'service',
            'status' => 'active',
            'price' => 75000000,
            'user_id' => 1
        ],
        [
            'category_id' => 4,
            'brand_id' => 3,
            'title' => 'حجم گاز پنجاه کیلوئی CO2',
            'type' => 'service',
            'status' => 'active',
            'price' => 80000000,
            'user_id' => 1
        ],
        ///
        [
            'category_id' => 3,
            'brand_id' => 3,
            'title' => ' شیر دسته کامل CO2',
            'type' => 'goods',
            'status' => 'active',
            'price' => 80000000,
            'user_id' => 1
        ],
        [
            'category_id' => 3,
            'brand_id' => 3,
            'title' => ' شیپوری CO2',
            'type' => 'goods',
            'status' => 'active',
            'price' => 80000000,
            'user_id' => 1
        ],

    ];

    public function scopeSearch(Builder $query): void
    {

        $query->when(request()->input('date'), function ($query) {
            $query->whereDate('created_at', ">=", Carbon::now()->subMonths(request()->input('date'))->toDateString());
        })->when(request()->input('name'), function ($query) {
            $query->where('title', 'like', "%" . request()->input('name') . "%");
        })->when(request()->input('startDate'), function ($query) {
            $date = date('Y-m-d', changeFormatNumberToDate(request()->input('startDate')));
            $query->whereDate('created_at', ">=", $date);

        })->when(request()->input('endDate'), function ($query) {
            $date = date('Y-m-d', changeFormatNumberToDate(request()->input('endDate')));
            $query->whereDate('created_at', "<=", $date);
        });
    }

    protected function title(): Attribute
    {

        return Attribute::make(

            set: fn($value) => preg_replace("/(\s){1,}/imu", '-', $value)
        );
    }

    protected function removeUnderLine(): Attribute
    {
        return Attribute::make(
            get: fn() => str_replace('-', ' ', $this->title)
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
        if ($this->productRemaining()) {
            return true;
        } else {
            return false;
        }

    }

    public function productRemaining()
    {

        $cart = Cart::where('status', 'addToCart')->orWhere('status', 'applyToTheBank')->get();
        $cartItem = CartItem::where('product_id', $this->id)->whereIn('cart_id', $cart->pluck('id'))->get();
        if ($cartItem->count() > 0) {
            if ($this->type == 'goods') {
                $total = ($this->productTransaction()->latest()->first()->remain ?? 0) - $cartItem->sum('amount');
                return $total > 0 ? $total : 0;
            } else {
                return 'نامحدود';
            }
        }
        if ($this->type == 'goods')
            return $this->productTransaction()->latest()->first()->remain ?? 0;
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

        $myCart = Cart::where('status', 'addToCart')->when($user, function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->when(!$user, function ($query) {
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

    public function getTypePersian(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->type == 'goods' ? 'کالا' : 'سرویس'
        );
    }

    public function userFavorite()
    {
        return $this->belongsToMany(User::class, 'favorite_products', 'product_id', 'user_id')->withTimestamps();
    }

    public function getIsFavoriteAttribute()
    {
        $user = Auth::user();
        if (!$user) {
            return 0;
        }
        return $this->userFavorite()->where('user_id', $user->id)->exists() ? 1 : 0;
    }

}
