<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable=['name','description','image','publish','slug','meta_title','meta_description','keyword'];
    protected $table='testimonials';
}
