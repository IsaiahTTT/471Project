<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = ['user_id', 'order_date', 'total_amount', 'status', 'shipping_name', 'shipping_address', 
    'shipping_city', 'shipping_state', 'shipping_zip'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}
