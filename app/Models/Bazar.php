<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bazar extends Model
{
    protected $fillable = ['operations_id', 'date', 'money_recipt', 'amount'];
}
