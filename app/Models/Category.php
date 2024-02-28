<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = ['name', 'sku'];

    protected $with = ['furnitures'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')->orWhere('sku', 'like', '%' . $search . '%');
        });
    }

    public function furnitures()
    {
        return $this->hasMany(Furniture::class);
    }
}
