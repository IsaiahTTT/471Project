<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'sku';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'sku',
        'name',
        'description',
        'price',
        'image_url',
        'stock',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'sku', 'sku');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'sku', 'sku');
    }

    public function getRouteKeyName(){
        return 'sku';
    }

}
