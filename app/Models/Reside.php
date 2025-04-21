<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reside extends Model
{
    protected $fillable=
        [
            'user_id',
            'operator_id',
            'bank_id',
            'status_bank',
            'total_price',
            'discount_collection',
            'final_price',
            'status',
            'type'
        ];
    public function resideItem()
    {
        return $this->hasMany(ResideItem::class,'reside_id');
    }
}
