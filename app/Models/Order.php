<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['user_id','invoice_id','total_price'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
    public function scopeSearch(Builder $query): void
    {

        $query->when(request()->input('date'),function ($query){
            $query->whereDate('created_at',">=",Carbon::now()->subMonths(request()->input('date'))->toDateString());
        })->when(request()->input('name'),function ($query){
            $user=User::where('mobile',request()->input('name'))->first();
            if ($user)
            $query->where('user_id',$user->id);
        })->when(request()->input('startDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('startDate')));
            $query->whereDate('created_at',">=",$date);

        })->when(request()->input('endDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('endDate')));
            $query->whereDate('created_at',"<=",$date);
        });
    }
}
