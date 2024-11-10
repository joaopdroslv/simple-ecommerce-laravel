<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;

class ProductController extends Controller
{
    public readonly Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->product->paginate(25);
        return view('product/admin/products', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product/admin/product_create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $formatted_price = str_replace(',', '.', $request->input('price'));
        if ($formatted_price) {
            return redirect()->back()->with('error', 'Failed to create!');
        }

        // Ignoring fields validation
        $created = $this->product->create([
            'name' => $request->input('name'),
            'brand' => $request->input('brand'),
            'description' => $request->input('description'),
            'price' => $formatted_price,
            'category_id' => $request->input('category_id'),
        ]);

        if ($created) {
            return redirect()->back()->with('success', 'Succesfully created!');
        }

        return redirect()->back()->with('error', 'Failed to create!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product/admin/product_show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product/admin/product_edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Ignore forms hidden fields
        $data = $request->except(['_token', '_method']);

        $updated = $this->product->where('id', $id)->update($data);

        if ($updated) {
            return redirect()->back()->with('success', 'Succesfully updated!');
        }

        return redirect()->back()->with('error', 'Failed to update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->product->where('id', $id)->delete();

        return redirect()->route('products.index');
    }

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
        $cart = $user ? $user->cart() : null;
        $productAlreadyInCart = $cart ? $cart->hasProduct($product->id) : 0;  # Product is in the shopping cart?
        $reviews = $product->reviews()->get();

        return view('product/customer/product_show', ['product' => $product, 'productAlreadyInCart' => $productAlreadyInCart, 'reviews' => $reviews]);
    }
}
