<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Relationship with Cart (an item belongs to a cart)
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relationship with Product (an item refers to a product)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
