<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, bool>
     */
    protected $fillable = [
        'user_id',
        'is_active',
    ];

    // Relationship with User (a cart belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with CartItem (a cart has many items)
    public function products()
    {
        return $this->hasMany(CartProduct::class);
    }

    public function hasProduct(string $productId)
    {
        $cartProduct = $this->products()->where('product_id', $productId)->first();
        return $cartProduct ? $cartProduct->quantity : 0;
    }

    public function cartTotal()
    {
        return $this->products()->get()->sum(function (CartProduct $item): float {
            return $item->price * $item->quantity;
        });
    }
}
