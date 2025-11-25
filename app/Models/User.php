<?php

namespace App\Models;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;

class User extends AuthUser
{
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
        'phone',
        'address',
        'photo',
        'dob',
        'gender'
    ];
    public function meals()
    {
        return $this->hasMany(Meal::class, 'user_id');
    }
}
