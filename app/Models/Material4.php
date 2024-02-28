<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material4 extends Model
{
    use HasFactory;

    protected $table = 'material4';

    protected $fillable = [
        'name',
        'sku'
    ];

    protected $with = ['furnitures'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });
    }

    public function furnitures()
    {
        return $this->hasMany(Furniture::class);
    }
}
