<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        logger("qwerty");
        return view('index', []);
    }

    public function categories()
    {
        return view('categories', []);
    }


    /**
     * @param $category
     * @param $product_code
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function product($category,$product_code)
    {
        $product = Product::where('code',$product_code)->first();
        return view('product', ['product' => $product]);
    }

    public function category($code)
    {
        $category = Category::where('code',$code)->first();
        return view('category', ['category'=>$category]);
    }
}
