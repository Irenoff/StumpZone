<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadmintonEquipment extends Model
{
    // Table name (optional if it's not plural of model name)
    protected $table = 'badminton_equipment';

    // Allow mass assignment on these fields
    protected $fillable = [
        'name',
        'type',
        'price',
        'description',
        'quantity',
        'status',
        'size',
        'image_url',
    ];
}
