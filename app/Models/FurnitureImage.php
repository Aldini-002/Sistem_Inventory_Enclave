<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnitureImage extends Model
{
    use HasFactory;

    protected $table = 'furniture_image';

    protected $fillable = [
        'furniture_id',
        'name',
        'url',
    ];

    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
