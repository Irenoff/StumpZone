<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CricketEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'description',
    'price',
    'image_path',
    'status',
    'quantity',
    'size'
     
];

}
