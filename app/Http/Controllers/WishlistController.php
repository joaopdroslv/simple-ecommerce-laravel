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
            return redirect()->back()->with('error', 'Product not found!');
        }

        $wishlistProduct = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($wishlistProduct) {
            return redirect()->back()->with('error', 'Product is already on your wish list!');
        }

        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Product added to your wish list!');
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();

        return redirect()->route('wishlists.index')->with('success', 'Product removed from your wish list!');
    }

    public function clear()
    {
        $user = auth()->user();

        Wishlist::where('user_id', $user->id)->delete();

        return redirect()->route('wishlists.index')->with('success', 'Wish list cleared!');
    }
}
