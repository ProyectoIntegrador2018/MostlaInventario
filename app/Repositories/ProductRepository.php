<?php 

namespace App\Repositories;

use App\Models\Campus;
use App\Models\Product;

class ProductRepository {

	public function allForUser($user)
	{
		return Product::withTrashed()
			->forUser($user)
			->orderBy('created_at', 'desc')
			->get();
	}

	public function findId($id)
	{
		return Product::withTrashed()
			->find($id);
	}
}
