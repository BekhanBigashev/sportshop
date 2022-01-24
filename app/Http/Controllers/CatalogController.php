<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->category ?? null;
        if ($category) {
            $products = Product::where('category_id', $category)->get();
        } else {
            $products = Product::all();
        }

        return view('catalog', compact('products'));
    }

    public function json(Request $request)
    {
//        $category = $request->category ?? null;
//        if ($category) {
//            $products = Product::where('category_id', $category)->get();
//        } else {
$products = Product::all();
//        }

        return response()->json($products->toArray(), 200);
    }
}
