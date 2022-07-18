<?php
namespace App\Repositories\Page;
use App\Repositories\Crud\CrudRepository;
use App\Models\Page;
class PageRepository extends CrudRepository implements PageInterface{
	public function __construct(Page $page){
		$this->model=$page;
	}
	public function create($input){
		$value=$input;
		$value['slug']=!empty($input['slug'])? str_slug($input['slug']) : str_slug($input['title']);
		$this->model->create($value);
	}
	public function update($input,$id){
		$value=$input;
		$this->model->find($id)->update($value);
	}
}