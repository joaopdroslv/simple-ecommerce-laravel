<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $wishlistItems = Wishlist::where('user_id', $user->id)->get();

        return view('wishlist', ['wishlistItems' => $wishlistItems]);
    }

    public function store(Product $product)
    {
        $user = auth()->user();

        if (!$product) {
            return redirect()->back()->withErrors('Product not found!');
        }

        $wishlistProduct = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($wishlistProduct) {
            return redirect()->back()->withErrors(['error' => 'Product is already on your wishlist!']);
        }

        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist!');
    }

    public function destroy(Product $product)
    {
        $user = auth()->user();

        $wishlistProduct = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($wishlistProduct) {
            $wishlistProduct->delete();
            return redirect()->back()->with('success', 'Product removed from wishlist!');
        }

        return redirect()->back()->withErrors(['error' => 'Product not found in your wishlist!']);
    }

    public function clear()
    {
        $user = auth()->user();

        Wishlist::where('user_id', $user->id)->delete();

        return redirect()->back()->with('success', 'Wishlist cleared!');
    }
}
