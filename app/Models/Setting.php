<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function image()
    {
        return $this->morphOne(File::class, 'files', 'fileable_type', 'fileable_id', 'id');
    }
}
