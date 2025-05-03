<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
            'name'=>'توچال',
            'status'=>'active'
        ],
        [
            'name'=>'پارس گستر',
            'status'=>'active'
        ],
        [
            'name'=>'ایران پارس',
            'status'=>'active'
        ],
    ];
    public function scopeSearch(Builder $query): void
    {
        $query->when(request()->input('date'),function ($query){
            $query->whereDate('created_at',">=",Carbon::now()->subMonths(request()->input('date'))->toDateString());
        })->when(request()->input('name'),function ($query){
            $query->where('name','like',"%".request()->input('name').'%');
        })->when(request()->input('startDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('startDate')));
            $query->whereDate('created_at',">=",$date);

        })->when(request()->input('endDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('endDate')));
            $query->whereDate('created_at',"<=",$date);
        });
    }
    public function image()
    {
        return $this->morphOne(File::class,'files','fileable_type','fileable_id');
    }
    public function productes()
    {
        return $this->hasMany(Product::class,'brand_id');
    }
}
