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
            'description'

        ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
