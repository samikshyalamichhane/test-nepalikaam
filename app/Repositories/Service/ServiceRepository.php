<?php
namespace App\Repositories\Service;
use App\Repositories\Crud\CrudRepository;
use App\Models\Service;
class ServiceRepository extends CrudRepository implements ServiceInterface{
	public function __construct(Service $service){
		$this->model=$service;
	}
	public function create($input){
		$value=$input;
		$value['slug']=!empty($input['slug'])? str_slug($input['slug']) : str_slug($input['title']);
		
		$this->model->create($value);
	}
	public function update($input,$id){
		$value=$input;
		$value['slug']=!empty($input['slug'])? str_slug($input['slug']) : str_slug($input['title']);
		$this->model->find($id)->update($value);
	}
}