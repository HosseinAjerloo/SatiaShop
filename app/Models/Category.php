<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'view_sort', 'status', 'menu_id','category_id'];
    const CategoryRecord =
        [
            [
                'name' => 'سامسونگ',
                'view_sort' => 1,
                'status' => 'active',
                'menu_id' => 1
            ],
            [
                'name' => 'apple',
                'view_sort' => 4,
                'status' => 'active',
                'menu_id' => 2
            ]
        ];

    public function scopeSearch(Builder $query): void
    {

        $query->when(request()->input('date'),function ($query){
            $query->whereDate('created_at',">=",Carbon::now()->subMonths(request()->input('date'))->toDateString());
        })->when(request()->input('name'),function ($query){
            $query->where('name','like',"%".request()->input('name')."%");
        });
    }

    protected function name():Attribute
    {
        return Attribute::make(
            set: fn($value)=>preg_replace("/(\s){1,}/imu",'-',$value)
        );
    }

    protected function removeUnderLine():Attribute
    {
        return Attribute::make(
            get: fn()=>str_replace('-',' ',$this->name)
        );
    }
    public function image()
    {
        return $this->morphOne(File::class, 'files', 'fileable_type', 'fileable_id', 'id');

    }
    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }
    public function parent()
    {
        return $this->belongsTo($this,'category_id');
    }
    public function chidren()
    {
        return $this->hasMany($this,'category_id');
    }
    public function productes()
    {
        return $this->hasMany(Product::class,'category_id');
    }
}
