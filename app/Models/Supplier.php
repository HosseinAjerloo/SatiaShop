<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['supplier_category_id','name','mobile','status','address','phone'];
    const SupplierRecord=
        [
            [
                'supplier_category_id'=>1,
                'name'=>'سایتا',
                'mobile'=>'123456789',
                'status'=>'active',
                'address'=>'اراک',
                'phone'=>'09186414452'
            ],
            [
                'supplier_category_id'=>2,
                'name'=>'رایانکده',
                'mobile'=>'123456789',
                'status'=>'active',
                'address'=>'اراک',
                'phone'=>'09386542718'
            ]
        ];

    public function supplierCategory(){
        return $this->belongsTo(SupplierCategory::class,'supplier_category_id');
    }
}
