<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSelect extends Model
{
    use HasFactory;

    protected $table = 'order_select';

    protected $fillable = [
        'furniture_id',
    ];

    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
