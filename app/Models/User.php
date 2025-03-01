<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Traits\HasConfig;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;


class User extends Authenticatable
{
    use HasConfig, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    const users =
        [
            'name' => "حسین",
            'family' => "آجرلو",
            'mobile' => "09186414452",
            'type' => 'admin',

        ];
    protected $fillable = [
        'name',
        'email',
        'password',
        "family",
        "national_code",
        "username",
        "mobile",
        "tel",
        "address",
        "is_active",
        "type"
    ];
    public function scopeSearch(Builder $query): void
    {

        $query->when(request()->input('date'),function ($query){
            $query->whereDate('created_at',">=",Carbon::now()->subMonths(request()->input('date'))->toDateString());
        })->when(request()->input('name'),function ($query){
            $query->where('mobile','like',"%".request()->input('name')."%");
        })->when(request()->input('startDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('startDate')));
            $query->whereDate('created_at',">=",$date);

        })->when(request()->input('endDate'),function ($query){
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('endDate')));
            $query->whereDate('created_at',"<=",$date);
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function financeTransactions()
    {
        return $this->hasMany(FinanceTransaction::class, 'user_id');
    }

    public function getCreaditBalance()
    {
        return $this->financeTransactions()->orderBy('id', 'desc')->first()->creadit_balance ?? 0;
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (isset($this->name) and isset($this->family)) {
                    return $this->name . ' ' . $this->family;
                } elseif (isset($this->name)) {
                    return $this->name;
                } elseif (isset($this->family)) {
                    return $this->family;
                } else {
                    return $this->mobile;
                }
            });
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id', 'id', 'id');
    }



    public function orders()
    {
        return $this->hasMany(Order::class,'user_id');
    }

}
