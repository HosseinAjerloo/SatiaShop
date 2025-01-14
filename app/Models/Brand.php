<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=
        [
            'name',
            'status'
        ];
    const Brands=[
        [
            'name'=>'nokia',
            'status'=>'active'
        ],
        [
            'name'=>'lg',
            'status'=>'active'
        ]
    ];
    public function image()
    {
        return $this->morphOne(File::class,'files','fileable_type','fileable_id');
    }
}
