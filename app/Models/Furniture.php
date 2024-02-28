<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    use HasFactory;

    protected $table = 'furniture';

    protected $fillable = [
        'category_id',
        'material1_id',
        'material2_id',
        'material3_id',
        'material4_id',
        'sku',
        'name',
        'description',
        'length',
        'width',
        'height',
        'size',
        'keyword',
        'price',
        'payment_options',
        'payment_terms',
        'delivery_terms',
        'delivery_time',
        'lead_time',
        'packing',
        'port',
        'certification',
        'qty_per_month',
        'moq',
        'stock',
        'convertible',
        'adjustable',
        'folded',
        'extendable',
    ];

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        });

        $query->when($filters['material1'] ?? false, function ($query, $material1) {
            return $query->whereHas('material1', function ($query) use ($material1) {
                $query->where('name', $material1);
            });
        });

        $query->when($filters['material2'] ?? false, function ($query, $material2) {
            return $query->whereHas('material2', function ($query) use ($material2) {
                $query->where('name', $material2);
            });
        });

        $query->when($filters['material3'] ?? false, function ($query, $material3) {
            return $query->whereHas('material3', function ($query) use ($material3) {
                $query->where('name', $material3);
            });
        });

        $query->when($filters['material4'] ?? false, function ($query, $material4) {
            return $query->whereHas('material4', function ($query) use ($material4) {
                $query->where('name', $material4);
            });
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('sku', 'like', '%' . $search . '%')
                ->orWhere('keyword', 'like', '%' . $search . '%');
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function material1()
    {
        return $this->belongsTo(Material1::class);
    }

    public function material2()
    {
        return $this->belongsTo(Material2::class);
    }

    public function material3()
    {
        return $this->belongsTo(Material3::class);
    }

    public function material4()
    {
        return $this->belongsTo(Material4::class);
    }

    public function furniture_images()
    {
        return $this->hasMany(FurnitureImage::class);
    }

    public function order_furnitures()
    {
        return $this->hasMany(OrderFurniture::class);
    }

    public function order_select()
    {
        return $this->hasOne(OrderSelect::class);
    }
}
