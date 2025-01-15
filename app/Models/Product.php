<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'category_id',
        'brand_id',
        'title',
        'description',
        'type',
        'status',
        'price',
        'user_id'
    ];
    const Products=[
        [
            'category_id'=>1,
            'brand_id'=>1,
            'title'=>'samsung a12',
            'type'=>'goods',
            'status'=>'active',
            'price'=>120000000,
            'user_id'=>1

        ],
        [
            'category_id'=>2,
            'brand_id'=>2,
            'title'=>'iphone 16',
            'type'=>'goods',
            'status'=>'active',
            'price'=>1000000000,
            'user_id'=>1
        ],
    ];
    public function image(){
        return $this->morphOne(File::class,'files','fileable_type','fileable_id');
    }
    public function productTransaction(){
        return $this->hasMany(ProductTransaction::class,'product_id','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
