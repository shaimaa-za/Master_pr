<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items');
    }
}
