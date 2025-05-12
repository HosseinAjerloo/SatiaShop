<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable=['name','persian_name'];
    const permission=[
        [
            'name'=>'charging-the-capsule',
            'persian_name'=>'پذیرش کپسول'
        ],
        [
            'name'=>'sale',
            'persian_name'=>'فروش کپسول'
        ],
        [
            'name'=>'reside-capsule',
            'persian_name'=>'لیست رسید ها'
        ],
        [
            'name'=>'reside-capsule',
            'persian_name'=>'دستبه لندی ها'
        ],
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'permission_roles','permission_id','role_id')->withTimestamps();
    }
}
