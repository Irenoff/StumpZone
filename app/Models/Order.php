<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    // Allow both new and legacy columns
    protected $fillable = [
        'user_id',
        'order_number',
        'items_total',
        'delivery_fee',
        'grand_total',
        'status',
        'processing_message',
        'customer_email',
        'customer_address',
        'delivery_method',

        // legacy columns (single-item orders)
        'sport_type',
        'equipment_id',
        'quantity',
        'price',
        'total',
    ];

    protected $casts = [
        'items_total'  => 'float',
        'delivery_fee' => 'float',
        'grand_total'  => 'float',
        'price'        => 'float',
        'total'        => 'float',
    ];

    /** The customer who placed the order */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Line items belonging to the order */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /** Delivery record created when vendor confirms */
    public function delivery(): HasOne
    {
        return $this->hasOne(Delivery::class);
    }
}
