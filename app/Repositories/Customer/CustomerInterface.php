<?php
namespace App\Repositories\Customer;
use App\Repositories\Crud\CrudInterface;
interface CustomerInterface extends CrudInterface{
	public function create($input);
	public function update($data,$id);
	public function changeStatus($id,$status);	
	public function approveCustomer($id);
	public function rejectCustomer($id);
}