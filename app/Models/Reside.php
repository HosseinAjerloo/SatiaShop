<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        })->when(request()->input('count_capsule'), function ($query) {
            $query->whereHas('resideItem',function ($builder){
               $builder->where('status','recharge');
            },request()->input('count_capsule'));
        })->when(request()->input('reside_id'), function ($query) {
            $query->where('id', request()->input('reside_id'));
        })->when(request()->input('operator_name'), function ($query) {
            $name = request()->input('operator_name');
            $user = User::where(function ($query) use ($name) {
                $query->orWhere('name', 'like', "%$name%")->orWhere('family', 'like', "%$name%");
            })->first();
            $user ? $query->where('user_id', $user->id) : '';
        })->when(request()->input('created_at'), function ($query) {
            $date = substr(request()->input('created_at'), 0, 10);
            $date = date('Y/m/d', $date);

            $query->whereDate('created_at', ">=", $date);
        });
    }
    public function totalPrice()
    {
        $total=0;
        foreach ($this->resideItem as $item) {
            $total += $item->getTotalProductPriceItems();
        }
        return $total;
    }

    public function totalPricePlusTax()
    {
        $total=$this->totalPrice();
        if ($this->commission>0)
        {
            $total=(($total * $this->commission )/100)+ $total;
        }
        return $total;
    }
}
