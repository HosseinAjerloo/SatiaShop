<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTransaction extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'product_id',
        'user_id',
        'invoice_id',
        'amount','remain'
        ,'type'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
    public function getType()
    {
        return $this->type=='add'?'افزایش':'کاهش';
    }
}
