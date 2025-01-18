<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
        [
            'user_id',
            'bank_id',
            'status_bank',
            'final_amount',
            'type',
            'status',
            'type_of_business',
            'description',
            'supplier_id',
            'operator_id'
        ];

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


    public function voucherAmount()
    {
        if ($this->service_id) {
            return $this->service->amount;
        } elseif ($this->service_id_custom) {
            return $this->service_id_custom;
        } else {
            return false;
        }
    }

    public function persianType()
    {
        return match ($this->type) {
            "service" => "خرید کارت هدیه پرفکت مانی",
            "wallet" => "افزایش کیف پول",
            "transmission" => "انتقال حواله کارت هدیه پرفکت مانی",
            default => ''
        };
    }
}
