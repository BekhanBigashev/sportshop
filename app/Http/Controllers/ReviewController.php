<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function add(Request $request)
    {
        $review = new Review;
        $review->name = $request->input('name');
        $review->product_id = $request->input('product_id');
        $review->text = $request->input('text');
        $review->score = $request->input('score');
        $review->save();
        return redirect()->back();
    }
}
