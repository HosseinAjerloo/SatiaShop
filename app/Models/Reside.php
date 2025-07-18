<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Reside extends Model
{
    protected $fillable =
        [
            'user_id',
            'operator_id',
            'bank_id',
            'status_bank',
            'total_price',
            'commission',
            'discount_collection',
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
        })->when(request()->input('reside_type'), function ($query) {
            $resideType = request()->input('reside_type');
            if (str_contains($resideType, 'شارژ')) {
                $query->where('reside_type', 'recharge');
            } elseif (str_contains($resideType, 'فروش')) {
                $query->where('reside_type', 'sell');

            }
        })->when(request()->input('count_capsule'), function ($query) {
            $query->whereHas('resideItem', function ($builder) {
                $builder->where('status', 'sell')
                    ->groupBy('reside_id')
                    ->havingRaw('SUM(amount) >= ?', [request()->input('count_capsule')]);
            })->orWhereHas('resideItem', function ($builder) {
                $builder->whereIn('status', ['used', 'recharge'])
                    ->groupBy('reside_id')
                    ->havingRaw('COUNT(*) >= ?', [request()->input('count_capsule')]);
            });
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

            $query->whereDate('created_at', ">=", $date);
        });
    }

    public function totalPrice()
    {
        $total = 0;
        foreach ($this->resideItem as $item) {
            $total += $item->getTotalProductPriceItems();
        }
        return $total;
    }

    public function totalPriceSale()
    {
        $total = 0;
        foreach ($this->resideItem as $item) {
            $total += $item->price * $item->amount;
        }
        return $total;
    }

    public function totalPricePlusTax()
    {
        $total = $this->totalPrice();

        if ($this->commission > 0) {
            $total = (($total * $this->commission) / 100) + $total;
        }
        return $total;
    }
    public function file(){
        return $this->morphOne(File::class,'files','fileable_type','fileable_id');
    }
}
