<?php
namespace App\Repositories\Slider;
use App\Repositories\Crud\CrudRepository;
use App\Models\Slider;
class SliderRepository extends CrudRepository implements SliderInterface{
	public function __construct(Slider $slider){
		$this->model=$slider;
	}
	public function create($input){
		$this->model->create($input);
	}
	public function update($input,$id){
		$this->model->find($id)->update($input);
	}
}