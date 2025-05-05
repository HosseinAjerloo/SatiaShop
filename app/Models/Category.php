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

    protected $fillable = ['name', 'view_sort', 'status', 'menu_id', 'category_id'];
    const CategoryRecord =
        [
            [
                'name' => ' کپسول پودر و گاز',
                'view_sort' => 1,
                'status' => 'active',
                'menu_id' => 1
            ],
            [
                'name' => ' کپسول آب و کف',
                'view_sort' => 2,
                'status' => 'active',
                'menu_id' => 1
            ],
            [
                'name' => ' کپسول گاز CO2',
                'view_sort' => 3,
                'status' => 'active',
                'menu_id' => 1
            ],
            [
                'name' => ' کالای مبوط به آب و کف',
                'view_sort' => 4,
                'status' => 'active',
                'menu_id' => 1
            ],
            [
                'name' => ' کالای مبوط به پودر و گاز',
                'view_sort' => 5,
                'status' => 'active',
                'menu_id' => 1
            ],
            [
                'name' => ' کالای مبوط به Co2',
                'view_sort' => 6,
                'status' => 'active',
                'menu_id' => 1
            ],

            [
                'name' => 'گاز (پودر و گاز)',
                'view_sort' => 1,
                'status' => 'active',
                'menu_id' => 2,
                'category_id'=>5
            ],
            [
                'name' => 'پودر مصرفی (پودر و گاز)',
                'view_sort' => 2,
                'status' => 'active',
                'menu_id' => 2,
                'category_id'=>5
            ],
            [
                'name' => 'مایع کف (آب و کف)',
                'view_sort' => 3,
                'status' => 'active',
                'menu_id' => 2,
                'category_id'=>4

            ],
            [
                'name' => 'گاز (گاز Co2)',
                'view_sort' => 1,
                'status' => 'active',
                'menu_id' => 2,
                'category_id'=>6
            ],



        ];

    public function scopeSearch(Builder $query): void
    {
        $query->when(request()->input('date'), function ($query) {
            $query->whereDate('created_at', ">=", Carbon::now()->subMonths(request()->input('date'))->toDateString());
        })->when(request()->input('name'), function ($query) {
            $query->where('name', 'like', "%" . request()->input('name') . "%");
        })->when(request()->input('startDate'), function ($query) {
            $date = date('Y-m-d', changeFormatNumberToDate(request()->input('startDate')));
            $query->whereDate('created_at', ">=", $date);

        })->when(request()->input('endDate'), function ($query) {
            $date = date('Y-m-d', changeFormatNumberToDate(request()->input('endDate')));
            $query->whereDate('created_at', "<=", $date);
        });
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => preg_replace("/(\s){1,}/imu", '-', $value)
        );
    }

    protected function removeUnderLine(): Attribute
    {
        return Attribute::make(
            get: fn() => str_replace('-', ' ', $this->name)
        );
    }

    public function image()
    {
        return $this->morphOne(File::class, 'files', 'fileable_type', 'fileable_id', 'id');

    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function parent()
    {
        return $this->belongsTo($this, 'category_id');
    }

    public function chidren()
    {
        return $this->hasMany($this, 'category_id');
    }

    public function productes()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function getAllParent()
    {
        $categoryParent = $this->parent;
        $parentName = $categoryParent->removeUnderLine;
        while ($categoryParent = $categoryParent->parent) {
            $parentName .= "/" . $categoryParent->removeUnderLine;
        }

        return $parentName;

    }
}
