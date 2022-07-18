<?php

namespace App\Repositories\Transaction;

use App\Repositories\Crud\CrudRepository;
use App\Models\Transaction;

class TransactionRepository extends CrudRepository implements TransactionInterface
{
	public function __construct(Transaction $transaction)
	{
		$this->model = $transaction;
	}
	public function create($data)
	{
		$data = $this->model->create($data);
		if ($data) {
			return $data;
		} else {
			return;
		}
	}
	public function update($data, $id)
	{
		$data = $this->model->find($id)->update($data);
		return $data;
	}
	public function changeStatus($id, $status)
	{
		$page = $this->model->find($id);
		if ($page->status == $status) {
			return;
		} else {
			$page->status = $status;
			if ($status == '2') {
				$page->received_date = date('Y-m-d H:i:s');
			}
			$page->new = 1;
			$page->save();
			return $page;
		}
	}
}
