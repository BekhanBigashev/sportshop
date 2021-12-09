<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view('index', []);
    }

    public function categories(){
        return view('categories', []);
    }
    public function product($category,$product_code){
        $product = Product::where('code',$product_code)->first();
        return view('product', ['product' => $product]);
    }

    public function category($code){
        $category = Category::where('code',$code)->first();
        return view('category', ['category'=>$category]);
    }
}
