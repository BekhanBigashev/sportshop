<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->category ?? null;
        $price = $request->price ?? null;
        $sort = $request->sort ?? null;
        if ($category) {
            $products = Product::whereIn('category_id', [$category]);
        } else {
            $products = Product::all();
        }
        if (count($products) > 0) {
            $products = $products->paginate(2)->withQueryString();
        } else {
            $products = false;
        }
        return view('catalog', compact('products'));
    }

    public function json(Request $request)
    {
        $products = Product::all();
        return response()->json($products->toArray(), 200);
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

    public function category(Request $request, $code)
    {
        $category = Category::where('code',$code)->first();
        if ($category->parent_id != 0) {
            $builder = Product::where('category_id', $category->id);
            $products = $builder->get();
            if ($request->has('sort') && in_array($request->sort, ['price', 'name'])) {
                if ($request->has('order') && in_array($request->order, ['asc', 'desc'])) {
                    $builder->orderBy($request->sort, $request->order);
                } else {
                    $builder->orderBy($request->sort, 'asc');
                }
            } else {
                if ($request->has('order') && in_array($request->order, ['asc', 'desc'])) {
                    $builder->orderBy('name', $request->order);
                }
            }
            $products = $builder->get();

            return view('catalog', ['products' => $products, 'params' => $request->all()]);
        } else {
            return view('category', ['category'=>$category]);
        }
    }
}
