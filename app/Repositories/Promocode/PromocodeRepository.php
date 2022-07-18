<?php

namespace App\Repositories\Promocode;

use App\Repositories\Crud\CrudRepository;
use App\Models\Promocode;

class PromocodeRepository extends CrudRepository implements PromocodeInterface
{
	public function __construct(Promocode $promocode)
	{
		$this->model = $promocode;
	}
	public function create($input)
	{
		return $this->model->create($input);
	}
	public function update($input, $id)
	{
		$this->model->find($id)->update($input);
	}

	public function store__promocode_user_table($id, $users)
	{
		$detail = $this->model->find($id);
		foreach ($users as $user) {
			$detail->users()->attach($user);
		}
	}
	public function update__promocode_user_table($id, $users)
	{
		$detail = $this->model->find($id);
		$detail->users()->sync($users);
	}
}
