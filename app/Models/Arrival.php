<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    protected $table = 'arrivals';

    protected $fillable = [
        'title','sport','price','description','stock','image_path','status',
    ];

    protected $casts = [
        'price'      => 'decimal:2',
        'stock'      => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
