<?php
namespace App\Repositories\Testimonial;
use App\Models\Testimonial;
use App\Repositories\Crud\CrudRepository;
class TestimonialRepository extends CrudRepository implements TestimonialInterface{
	public function __construct(Testimonial $testimonial){
		$this->model=$testimonial;
	}
	public function create($data){
		$this->model->create($data);
	}
	public function update($data,$id){
		$this->model->find($id)->update($data);
	}
}