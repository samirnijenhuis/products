<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'type_id',
        'stock_id',
    ];

    public $timestamps = false;

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

}
