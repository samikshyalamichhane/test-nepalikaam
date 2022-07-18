<?php
namespace App\Repositories\Testimonial;
use App\Repositories\Crud\CrudInterface;
interface TestimonialInterface extends CrudInterface{
	public function create($data);
	public function update($data,$id);
}