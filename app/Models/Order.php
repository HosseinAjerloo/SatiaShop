<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['user_id','invoice_id','total_price'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
