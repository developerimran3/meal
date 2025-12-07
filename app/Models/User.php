<?php

namespace App\Models;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Notifications\Notifiable;

class User extends AuthUser
{
    use Notifiable;

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
        'set_no'
    ];


    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
