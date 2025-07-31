<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoxingEquipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'boxing_equipment';

    protected $fillable = [
      
    'name',
    'description',
    'price',
    'quantity',
    'status',
    'size',
    'image_path',
];

    

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : 'https://via.placeholder.com/300?text=Boxing';
    }
}