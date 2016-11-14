<?php

namespace App\Repositories;

use App\Models\Product;
use Bosnadev\Repositories\Eloquent\Repository;

class ProductRepository extends Repository {


    /**
     * UserRepository constructor.
     */
    public function model()
    {
        return Product::class;
    }

}