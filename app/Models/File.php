<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['fileable_id','fileable_type','user_id','path'];
    public function fileable()
    {
        return $this->morphTo();
    }
}
