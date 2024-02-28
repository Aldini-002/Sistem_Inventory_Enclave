<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFurniture extends Model
{
    use HasFactory;
    protected $table = 'order_furniture';

    protected $fillable = [
        'order_id',
        'furniture_id',
        'qty',
        'price',
        'total',
    ];

    // public function scopeFilter($query, array $filters)
    // {
    //     $query->when($filters['search'] ?? false, function ($query, $search) {
    //         return $query
    //             ->whereHas('furniture', function ($query) use ($search) {
    //                 $query
    //                     ->where('name', 'like', '%' . $search . '%')
    //                     ->orWhere('sku', 'like', '%' . $search . '%');
    //             })
    //             ->orwhereHas('supplier', function ($query) use ($search) {
    //                 $query
    //                     ->where('name', 'like', '%' . $search . '%')
    //                     ->orWhere('phone', 'like', '%' . $search . '%');
    //             })
    //             ->orwhere('no_po', 'like', '%' . $search . '%')
    //             ->orWhere('orderer', 'like', '%' . $search . '%');
    //     });

    //     $query->when($filters['status'] ?? false, function ($query, $status) {
    //         return $query
    //             ->where('status', $status);
    //     });
    // }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
