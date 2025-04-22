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
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function operator()
    {
        return $this->belongsTo(User::class,'operator_id');
    }
}
