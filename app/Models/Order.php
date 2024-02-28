<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'supplier_id',
        'no_po',
        'orderer',
        'deadline',
        'status',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query
                ->orwhereHas('supplier', function ($query) use ($search) {
                    $query
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%');
                })
                ->orwhere('no_po', 'like', '%' . $search . '%')
                ->orWhere('orderer', 'like', '%' . $search . '%');
        });

        $query->when($filters['status'] ?? false, function ($query, $status) {
            return $query
                ->where('status', $status);
        });
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function order_furnitures()
    {
        return $this->hasMany(OrderFurniture::class);
    }
}
