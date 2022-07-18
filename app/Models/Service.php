<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table='services';
    protected $fillable=['title','slug','description','image','meta_title','meta_description','publish','short_description','header','order','keyword'];
}
