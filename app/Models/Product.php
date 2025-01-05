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
    public function images(){
        return $this->morphMany(File::class,'files','fileable_type','fileable_id','id');
    }
    public function productTransaction(){
        return $this->hasOne(ProductTransaction::class,'product_id','id');
    }
}
