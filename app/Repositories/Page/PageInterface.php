<?php 
namespace App\Repositories\Page;
use App\Repositories\Crud\CrudInterface;
interface PageInterface extends CrudInterface{
	public function create($input);
	public function update($input,$id);
	
} 