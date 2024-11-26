<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'max:1000'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        Review::create([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'product_id' => $request->product_id,
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully');
    }
}
