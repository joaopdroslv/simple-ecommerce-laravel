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
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function cartTotal()
    {
        return $this->items()->get()->sum(function (CartItem $item): float {
            return $item->price * $item->quantity;
        });
    }
}
