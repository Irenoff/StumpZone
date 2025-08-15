<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadmintonEquipment extends Model
{
    protected $table = 'badminton_equipment'; // match your DB table

    protected $fillable = [
           'name',
    'description',
    'price',
    'quantity',
    'status',
    'size',
     'image_path',
    
    ];
}
