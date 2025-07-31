<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballEquipment extends Model
{
    use HasFactory;

    protected $table = 'football_equipment';

    protected $fillable = [
     'name',
    'description',
    'price',
    'image_path',
    'quantity',
    'status',
    'size', 
    ];
}
