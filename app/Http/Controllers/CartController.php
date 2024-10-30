<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;

class CartController extends Controller
{
    public function showCart()
    {
        $user = auth()->user();
        $cart = Cart::getActiveCartForUser($user->id);
        $cartItems = $cart->items()->get();
        $cartTotal = $cart->cartTotal();

        return view('cart', ['cartItems' => $cartItems, 'cartTotal' => $cartTotal]);
    }

    public function addToCart(Product $product)
    {
        $user = auth()->user();
        $cart = $user->carts()->where('is_active', true)->first();

        if (!$cart) {
            $cart = Cart::create(['user_id' => $user->id, 'is_active' => true]);
        }

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        // If product already exists in cart, add one more
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // If not, create cartItem
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price
            ]);
        }

        return redirect()->back()->with('success', 'Product added to your shopping cart!');
    }
}
