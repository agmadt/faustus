<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Profile extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'avatar',
    ];
}
