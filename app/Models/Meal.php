<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = ['user_id', 'date', 'breakfast', 'lunch', 'dinner'];

    public function member()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function totalMeals()
    {
        return $this->breakfast + $this->lunch + $this->dinner;
    }
}
