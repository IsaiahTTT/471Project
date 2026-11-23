<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $primaryKey = 'order_item_id';

    public $timestamps = false;

    public$fillable = ['order_id', 'sku', 'quantity', 'unit_price'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'sku', 'sku');
    }
}
