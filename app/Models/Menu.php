<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'view_sort', 'status'];

    const MenuRecord=
        [
          [
             'name'=>'منوی محصول',
              'view_sort'=>1,
              'status'=>'active'
          ],
            [
                'name'=>'منوی خدمات',
                'view_sort'=>2,
                'status'=>'active'
            ]
        ];
    public function scopeSearch(Builder $query): void
    {

        $query->when(request()->input('date'),function ($query){
            $query->whereDate('created_at',">=",Carbon::now()->subMonths(request()->input('date'))->toDateString());
        })->when(request()->input('name'),function ($query){
            $query->where('name','like',"%".request()->input('name')."%");
        })->when(request()->input('startDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('startDate')));
            $query->whereDate('created_at',">=",$date);

        })->when(request()->input('endDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('endDate')));
            $query->whereDate('created_at',"<=",$date);
        });
    }
    public function category()
    {
        return $this->hasMany(Category::class,'menu_id');
    }
    public function categoryShow()
    {
        return $this->category()->where("status",'active')->orderBy('view_sort','asc')->get();
    }
}
