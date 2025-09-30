<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cart_id',
        'product_id',
        'price',
        'amount',
        'type',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function parentCart()
    {
        return $this->belongsTo(Cart::class,'cart_id');
    }
}
