<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'equipment_id',
        'sport_type',
        'size',
        'quantity'
    ];

    public $timestamps = true;
}
