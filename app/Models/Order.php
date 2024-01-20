<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Relación 1:N (un usuario puede tener varios pedidos)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación N:N (un pedido puede tener varios productos)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('quantity');
    }
}
