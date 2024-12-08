<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_email',
        'contact_phone',
        'api_url',
        'api_key',
        'address',
    ];
}
