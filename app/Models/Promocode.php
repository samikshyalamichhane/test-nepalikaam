<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /*
    * Multiple relationships
    **/

    public function users()
    {
        return $this->belongsToMany(User::class, 'promocode_user', 'promocode_id', 'user_id')->withTimestamps()->withPivot(['is_expired'])->wherePivot('is_expired', 0);
    }
}
