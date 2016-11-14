<?php

namespace Snijenhuis\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'social_providers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider', 'user_id', 'provider_user_id', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

}
