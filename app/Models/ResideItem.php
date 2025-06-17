<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResideItem extends Model
{
    protected $fillable = [
        'reside_id',
        'product_id',
        'price',
        'amount',
        'type',
        'status',
        'description',
        'balloons',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function reside()
    {
        return $this->belongsTo(Reside::class, 'reside_id');
    }

    public function getStatusItem()
    {
        return $this->status == 'used' ? 'استفاده شده' : 'تمدید شارژ';
    }

    public function productResidItem()
    {
        return $this->belongsToMany(Product::class, 'product_reside_items', 'reside_item_id', 'product_id')->withPivot('price')->withTimestamps();
    }

    public function getTotalProductPriceItems()
    {
        $totalPrice = 0;
        foreach ($this->productResidItem as $product) {
            $totalPrice += ($product->pivot->price+ $this->product->salary);
        }
        return $totalPrice + ($this->salary ?? 0);
    }

    public function changeToQrcodeNameProduct()
    {
        $value = $this->productResidItem->pluck("title")->toArray();
        if (!empty($value)) {
            foreach ($value as $key => $item) {
                $value[$key] = str_replace('-', ' ', $item);
            }
            return implode(' / ', $value);
        } else
            return '-';

    }

}
