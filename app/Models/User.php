<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();
        // When saving a record and there is a password in the request, encrypt the password
        static::saving(function ($user) {
            // If the request has a password field, we've submitted a form...
            if (request()->has('password')) {
                $user->password = $user->getOriginal('password');
                // If the field is filled, user is requesting to set a new password
                if (request()->filled('password')) {
                    $user->password = Hash::make(request('password'));
                }
            }
        });
    }

    /* Relationship */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /* Accessor */
    public function getFullNameAttribute()
    {
        return $this->profile->first_name . ' ' . $this->profile->last_name;
    }
}
