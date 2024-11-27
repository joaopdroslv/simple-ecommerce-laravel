<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Str;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'address_id',
        'order_number',
        'total',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = self::generateOrderNumber();
        });
    }

    public static function generateOrderNumber()
    {
        $randomNumber = str_pad(rand(1000000000, 9999999999), 10, '0', STR_PAD_LEFT);

        return 'ORDER-' . $randomNumber;
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}