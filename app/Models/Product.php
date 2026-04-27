<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'category',
        'image',
        'rating',
        'is_featured',
        'status' // For 'Available' or 'Out of Stock'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
