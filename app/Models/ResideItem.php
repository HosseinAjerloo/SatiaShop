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
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function getStatusItem()
    {
        return $this->status=='used'?'استفاده شده':'تمدید شارژ';
    }
    public function productResidItem()
    {
        return $this->belongsToMany(Product::class,'product_reside_items','reside_item_id','product_id')->withTimestamps()->withPivot('balloons','salary');
    }

}
