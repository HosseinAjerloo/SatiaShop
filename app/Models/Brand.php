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
            'name'=>'nokia',
            'status'=>'active'
        ],
        [
            'name'=>'lg',
            'status'=>'active'
        ]
    ];
    public function scopeSearch(Builder $query): void
    {
        $query->when(request()->input('date'),function ($query){
            $query->whereDate('created_at',">=",Carbon::now()->subMonths(request()->input('date'))->toDateString());
        })->when(request()->input('name'),function ($query){
            $query->where('name','like',"%".request()->input('name').'%');
        });
    }
    public function image()
    {
        return $this->morphOne(File::class,'files','fileable_type','fileable_id');
    }
}
