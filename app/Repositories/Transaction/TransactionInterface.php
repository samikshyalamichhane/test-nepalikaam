<?php
namespace App\Repositories\Transaction;
use App\Repositories\Crud\CrudInterface;
interface TransactionInterface extends CrudInterface{
	public function create($data);
	public function update($data,$id);
	public function changeStatus($id,$status);
}