<?php

namespace App\Models;

use App\Http\Traits\HasDiscount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Reside extends Model
{
    use SoftDeletes, HasDiscount;

    protected $fillable =
        [
            'user_id',
            'operator_id',
            'bank_id',
            'status_bank',
            'total_price',
            'commission',
            'discount_collection',
            'discount_price',
            'final_price',
            'status',
            'reside_type',
            'type',
            'description'
        ];

    public function resideItem()
    {
        return $this->hasMany(ResideItem::class, 'reside_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    protected function ScopeSearch(Builder $query): void
    {
        $query->when(request()->input('customer_name'), function ($query) {
            $name = request()->input('customer_name');
            $user = User::where(function ($query) use ($name) {
                $query->orWhere('name', 'like', "%$name%")->orWhere('family', 'like', "%$name%");
            })->first();
            $user ? $query->where('user_id', $user->id) : '';
        })->when(request()->input('count_capsule'), function ($query) {
            $query->when(request()->input('reside_type'), function ($query, $value) {
                $resideType = request()->input('reside_type');
                if (str_contains($resideType, 'شارژ')) {
                    $query->where('reside_type', 'recharge');
                } elseif (str_contains($resideType, 'فروش')) {
                    $query->where('reside_type', 'sell');

                }
            })->whereHas('resideItem', function ($builder) {
                $builder->where('status', 'sell')
                    ->groupBy('reside_id')
                    ->havingRaw('SUM(amount) >= ?', [request()->input('count_capsule')]);
            })->orWhereHas('resideItem', function ($builder) {
                $builder->whereIn('status', ['used', 'recharge'])
                    ->groupBy('reside_id')
                    ->havingRaw('COUNT(*) >= ?', [request()->input('count_capsule')]);
            });
        })->when(request()->input('reside_type'), function ($query) {
            $resideType = request()->input('reside_type');
            if (str_contains($resideType, 'شارژ')) {

                $query->where('reside_type', 'recharge');
            } elseif (str_contains($resideType, 'فروش')) {
                $query->where('reside_type', 'sell');

            }
        })->when(request()->input('reside_id'), function ($query) {
            $query->where('id', request()->input('reside_id'));
        })->when(request()->input('operator_name'), function ($query) {

            $name = request()->input('operator_name');
            User::where(function ($query) use ($name) {
                $query->orWhere('name', 'like', "%$name%")->orWhere('family', 'like', "%$name%");
            });
        })->when(request()->input('created_at'), function ($query) {
            $date = substr(request()->input('created_at'), 0, 10);
            $date = date('Y/m/d', $date);

            $query->whereDate('created_at', ">", $date);
        })->when(request()->input('type'), function ($query, $value) {
            $query->where('type', $value);
        });
    }

    public function totalPrice()
    {
        $total = 0;
        foreach ($this->resideItem as $item) {
            $total += $item->getTotalProductPriceItems();
        }
        return roundNumber($total);
    }

    public function totalPriceSale()
    {
        $total = 0;
        foreach ($this->resideItem as $item) {
            $total += $item->price * $item->amount;
        }
        return roundNumber($total);
    }

    public function totalPricePlusTax()
    {
        $total = $this->totalPrice();

        if ($this->commission > 0) {
            $total = (($total * $this->commission) / 100) + $total;
        }
        return roundNumber($total);
    }

    public function file()
    {
        return $this->morphMany(File::class, 'files', 'fileable_type', 'fileable_id');
    }

    public function isDiscount()
    {
        $status = false;
        if ($this->discount_collection > 0) {
            $status = true;
        } elseif ($this->discount_price > 0) {
            $status = true;
        }
        return $status;


    }

    public function calculationWithDiscount()
    {
        $price = $this->total_price;
        if ($this->discount_collection > 0) {
            $price = $this->calculateDecimal($this->total_price, $this->discount_collection);
        } elseif ($this->discount_price > 0) {
            $price = $this->calculatePrice($this->total_price, $this->discount_price);
        }

        return roundNumber($price);
    }

    protected function resideDiscountAmount(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->discount_collection) {
                    return numberFormat($this->discount_collection) . '%';
                } elseif ($this->discount_price) {
                    return numberFormat($this->discount_price) . "ریال";
                } else {
                    return 0;
                }
            }
        );
    }

    protected function paymentPrice(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->final_price != 0 ? $this->final_price : $this->totalPrice();
        });
    }

}
