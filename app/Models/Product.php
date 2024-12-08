<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'category_id', 'price', 'stock', 'supplier_id'];
    
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_values')
                    ->withPivot('value') // نضيف القيمة للخاصية
                    ->withTimestamps();
    }

}
