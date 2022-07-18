<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['rate','offer_rate','offer_price'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    protected $cast = [
        'offer_rate'=>'string',
        'offer_price'=>'string',
        'rate'=>'float'
    ];
}
