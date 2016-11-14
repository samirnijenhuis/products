<?php

namespace App\Repositories;

use App\Models\Stock;
use Bosnadev\Repositories\Eloquent\Repository;

class StockRepository extends Repository {


    /**
     * UserRepository constructor.
     */
    public function model()
    {
        return Stock::class;
    }



}