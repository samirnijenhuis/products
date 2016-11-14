<?php

namespace App\Repositories;

use App\Models\Type;
use Bosnadev\Repositories\Eloquent\Repository;

class TypeRepository extends Repository {


    /**
     * UserRepository constructor.
     */
    public function model()
    {
        return Type::class;
    }



}