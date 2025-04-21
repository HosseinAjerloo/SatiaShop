<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResideItem extends Model
{
    protected $fillable=[
        'reside_id',
        'product_id',
        'price',
        'amount',
        'type',
        'status',
        'description'
    ];

}
