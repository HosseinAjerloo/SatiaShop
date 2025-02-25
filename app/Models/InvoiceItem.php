<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
        [
            'invoice_id',
            'product_id',
            'price',
            'amount',
            'description',
            'type'
        ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
