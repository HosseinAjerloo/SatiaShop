<?php

namespace App\Models;

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
             'name'=>'منوی اول',
              'view_sort'=>4,
              'status'=>'active'
          ],
            [
                'name'=>'منوی دوم',
                'view_sort'=>3,
                'status'=>'active'
            ]
        ];

    public function category()
    {
        return $this->hasMany(Category::class,'menu_id');
    }
    public function categoryShow()
    {
        return $this->category()->where("status",'active')->orderBy('view_sort','asc')->get();
    }
}
