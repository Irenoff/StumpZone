<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'name',         // equipment name
        'sport_type',   // optional: cricket/football/etc.
        'price',
        'quantity',
    ];

    protected $casts = [
        'price'    => 'float',
        'quantity' => 'int',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
