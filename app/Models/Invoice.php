<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
        [
            'user_id',
            'bank_id',
            'status_bank',
            'final_amount',
            'status',
            'type_of_business',
            'description',
            'supplier_id',
            'operator_id',
            'discount_collection',
            'discount_id'
        ];

    public function scopeSearch(Builder $query): void
    {

        $query->when(request()->input('date'),function ($query){
            $query->whereDate('created_at',">=",Carbon::now()->subMonths(request()->input('date'))->toDateString());
        })->when(request()->input('name'),function ($query){
            $user=User::where('mobile',request()->input('name'))->first();
            $query->where('user_id',$user->id);
        })->when(request()->input('startDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('startDate')));
            $query->whereDate('created_at',">=",$date);

        })->when(request()->input('endDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('endDate')));
            $query->whereDate('created_at',"<=",$date);
        });
    }

    public function invoiceItem(){
        return $this->hasMany(InvoiceItem::class,'invoice_id');
    }



    public function productTransaction(){
        return $this->hasMany(ProductTransaction::class,'invoice_id');
    }


    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'invoice_id');
    }



    public function transferm()
    {
        return $this->hasOne(Transmission::class, 'invoice_id');
    }





    public function statusPayment():bool
    {
        return $this->status=='paid'?true:false;
    }
    public function invoiceDate():string
    {
        return Jalalian::forge($this->create_at)->format('%A %d %B %Y'); // جمعه، 23 اسفند 97
    }
    public function invoiceTime():string
    {
        return Jalalian::forge($this->create_at)->format('H:i:s'); // جمعه، 23 اسفند 97
    }
}
