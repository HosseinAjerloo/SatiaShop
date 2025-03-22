<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Otp extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['mobile','code','token','seen_at'];
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y/m/d H:i:s');
    }
}
