<?php

namespace App;

use App\Models\Promocode;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'publish', 'access_level', 'title', 'main', 'verifyToken', 'image', 'new', 'citizenship', 'phone', 'address', 'suberb', 'state', 'post_code', 'country', 'access_level', 'flag', 'customerid', 'idtype', 'manualy', 'submit__transaction',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'user_id');
    }

    public function receivers()
    {
        return $this->hasMany('App\Models\Receiver', 'user_id');
    }

    /*
    * Multiple relationships
    **/

    public function promocodes()
    {
        return $this->belongsToMany(Promocode::class, 'promocode_user', 'user_id', 'promocode_id')->withTimestamps()->withPivot(['is_expired'])->wherePivot('is_expired', 0);
    }
}
