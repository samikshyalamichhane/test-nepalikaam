<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table='pages';
    protected $fillable=['title','slug','description','image','meta_title','meta_description','publish','short_description','header','order','subtitle'];
}
