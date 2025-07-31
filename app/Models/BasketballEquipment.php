<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasketballEquipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'basketball_equipment';

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'status',
        'type',
        'size',
        'color',
        'brand',
        'material',
        'image_path'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : 'https://via.placeholder.com/300?text=Basketball';
    }
}