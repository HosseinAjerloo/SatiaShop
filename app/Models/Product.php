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
        'title',
        'description',
        'type',
        'status',
        'price'
    ];
    const Products=[
        [
            'category_id'=>1,
            'title'=>'samsung a12',
            'type'=>'goods',
            'status'=>'active',
            'price'=>120000000

        ],
        [
            'category_id'=>2,
            'title'=>'iphone 16',
            'type'=>'goods',
            'status'=>'active',
            'price'=>1000000000

        ],
    ];
    public function images(){
        return $this->morphMany(File::class,'files','fileable_type','fileable_id','id');
    }
    public function productTransaction(){
        return $this->hasOne(ProductTransaction::class,'product_id','id');
    }
}
