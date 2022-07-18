<?php

namespace App\Repositories\Promocode;

use App\Repositories\Crud\CrudInterface;

interface PromocodeInterface extends CrudInterface
{
	public function create($input);
	public function update($input, $id);
}
