<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProducts()
    {
        $products = Product::all();
        return view('product/products', ['products' => $products]);
    }

    public function getProductsByCategoryId(string $categoryId)
    {
        $category = Category::where('id', $categoryId)->first();
        $products = Product::where('category_id', $categoryId)->get();
        return view('product/products', ['products' => $products, 'category' => $category]);
    }

    public function getProductsByFilter(Request $request)
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
        $products = $query->get();

        return view('product/products', ['products' => $products, 'category' => $category]);
    }

    public function index()
    {

    }

    public function show(Product $product)
    {
        return view('product/product_show', ['product' => $product]);
    }
}
