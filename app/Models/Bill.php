<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'month',
        'seat_rent',
        'wifi',
        'khala',
        'utility_bill',
        'total',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // public function bills(){
    //     return $this->seat_rent+$this->wifi+$this->
    // }
}
