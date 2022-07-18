<?php
namespace App\Repositories\Slider;
use App\Repositories\Crud\CrudInterface;
interface SliderInterface extends CrudInterface{
	public function create($input);
	public function update($input,$id);
}