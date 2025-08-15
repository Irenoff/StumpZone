<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Delivery extends Model
{
    protected $fillable = [
        'order_id',
        'customer_name',
        'customer_email',
        'customer_address',
        'items',       // JSON
        'total',       // grand total at confirmation time
        'status',      // pending|delivered|cancelled
    ];

    protected $casts = [
        'items' => 'array',
        'total' => 'float',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
