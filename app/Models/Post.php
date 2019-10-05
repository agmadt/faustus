<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Post extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description'];
}
