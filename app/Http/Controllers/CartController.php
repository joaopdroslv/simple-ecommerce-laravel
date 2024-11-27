<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;

class CartController extends Controller
{
    public function showCart()
    {
        $user = auth()->user();
        $cart = $user->cart();
        $cartProducts = $cart->cartProducts()->get();
        $cartTotal = $cart->cartTotal();
        $addresses = $user->addresses()->get();

        return view(
            'cart',
            ['cartProducts' => $cartProducts, 'cartTotal' => $cartTotal, 'addresses' => $addresses]
        );
    }

    public function addOneToCart(Product $product)
    {
        $user = auth()->user();
        $cart = $user->cart();

        $cartProduct = $cart->cartProducts()->firstOrCreate(
            ['product_id' => $product->id],
            ['quantity' => 0, 'price' => $product->price]
        );

        $cartProduct->quantity += 1;
        $cartProduct->save();

        return redirect()->back()->with('success', 'Product updated in your shopping cart!');
    }

    public function removeOneFromCart(Product $product)
    {
        $user = auth()->user();
        $cart = $user->cart();
        $cartProduct = $cart->cartProducts()->where('product_id', $product->id)->first();

        if ($cartProduct) {
            $cartProduct->quantity -= 1;

            if ($cartProduct->quantity <= 0) {
                $cartProduct->delete();
                return redirect()->back()->with('success', 'Product removed from your shopping cart!');
            }
            $cartProduct->save();

            return redirect()->back()->with('success', 'Quantity decreased by one!');
        }

        return redirect()->back()->withErrors(['error' => 'Product not found in your cart!']);
    }

    public function removeAllFromCart(Product $product)
    {
        $user = auth()->user();
        $cart = $user->cart();
        $cartProduct = $cart->cartProducts()->where('product_id', $product->id)->first();

        if ($cartProduct) {
            $cartProduct->delete();
            return redirect()->back()->with('success', 'All of this product has been removed from your shopping cart!');
        }

        return redirect()->back()->withErrors(['error' => 'Product not found in your cart!']);
    }

    public function clearCart()
    {
        $user = auth()->user();
        $cart = $user->cart();
        $cart->cartProducts()->delete();

        return redirect()->back()->with('success', 'Shopping cart cleared!');
    }
}
