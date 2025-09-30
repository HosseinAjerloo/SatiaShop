<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'user_ip',
        'status',
        'finalPrice',
    ];

    public function cartItem()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
    public function checkoutTotal()
    {
        $totalPrice=0;
        $cartItems=$this->cartItem()->where('status','applyToTheBank')->get();
        foreach ($cartItems as $cartItem)
        {
            $totalPrice+=$cartItem->product->price*$cartItem->amount;
        }
        return $totalPrice;
    }


}
