<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $cart = $user->carts()->where('is_active', true)->first();
        $cartItems = $cart->items()->get();
        $cartTotal = $cart->cartTotal();

        return view('cart', ['cartItems' => $cartItems, 'cartTotal' => $cartTotal]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product)
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
