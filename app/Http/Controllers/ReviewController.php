<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:25',
            'text' => 'required|min:3|max:250',
            'score' => 'required',
            'product_id' => 'required',
        ]);
        $review = new Review;
        $review->name = $validated['name'];
        $review->product_id = $validated['product_id'];
        $review->text = $validated['text'];
        $review->score = $validated['score'];
        $review->save();
        return redirect()->back();
    }
}
