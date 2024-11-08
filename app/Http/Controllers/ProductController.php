<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;

class ProductController extends Controller
{
    public function getAll()
    {
        $products = Product::paginate(40);
        return view('product/customer/products', ['products' => $products]);
    }

    public function getByCategoryId(string $categoryId)
    {
        $category = Category::where('id', $categoryId)->first();
        $products = Product::where('category_id', $categoryId)->paginate(40);
        return view('product/customer/products', ['products' => $products, 'category' => $category]);
    }

    public function getByFilter(Request $request)
    {
        $productName = $request->input('product_name');
        $sortOrder = $request->input('sort_order');
        $categoryId = $request->input('category_id');

        $query = Product::query();

        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        if (!empty($productName)) {
            $query->where('name', 'like', '%' . $productName . '%');
        }

        if (!empty($sortOrder)) {
            $query->orderBy('price', $sortOrder);
        }

        $category = Category::where('id', $categoryId)->first();
        $products = $query->paginate(40);

        return view('product/customer/products', ['products' => $products, 'category' => $category]);
    }

    public function detail(Product $product)
    {
        $user = auth()->user();
        $cart = $user ? Cart::getActiveCartForUser($user->id) : null;
        $productAlreadyInCart = $cart ? $cart->hasProduct($product->id) : 0;  # Product is in the shopping cart?
        $reviews = $product->reviews()->get();

        return view('product/customer/product_show', ['product' => $product, 'productAlreadyInCart' => $productAlreadyInCart, 'reviews' => $reviews]);
    }

    public function index()
    {

    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
