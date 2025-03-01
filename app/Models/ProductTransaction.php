<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTransaction extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'product_id',
        'user_id',
        'invoice_id',
        'amount','remain'
        ,'type'
    ];
    public function scopeSearch(Builder $query): void
    {

        $query->when(request()->input('date'),function ($query){
            $query->whereDate('created_at',">=",Carbon::now()->subMonths(request()->input('date'))->toDateString());
        })->when(request()->input('name'),function ($query){
            $products=Product::where('title','like',"%".request()->input('name')."%")->get()->pluck('id');
            $query->whereIn('product_id',$products);
        })->when(request()->input('invoice'),function ($query){
            $query->where('invoice_id',request()->input('invoice'));
        })->when(request()->input('startDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('startDate')));
            $query->whereDate('created_at',">=",$date);

        })->when(request()->input('endDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('endDate')));
            $query->whereDate('created_at',"<=",$date);
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
    public function getType()
    {
        return $this->type=='add'?'افزایش':'کاهش';
    }
}
