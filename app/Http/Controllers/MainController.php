<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Services\TelegramService;
use Illuminate\Http\Request;

class MainController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('index', []);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%{$query}%")->paginate(10)->withQueryString();
        return view('search', ['products' => $products]);
    }

    public function fill_db_data($categoryCode)
    {
        return 1;
        $categories = [20, 8, 12, 14, 15, 16];
        foreach ($categories as $i) {
            $category = Category::find($i);
            $file = 'db_data/'.$category->code.'.csv';
            $handle = fopen($file, "r");
            $lineNumber = 1;

            while (($raw_string = fgets($handle)) !== false) {
                $row = str_getcsv($raw_string, ';');
                $product = new Product();
                $product->name = $row[0];
                $product->image = 'images/'.$category->code.'/'.$row[2];
                $product->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus suscipit vel turpis a ullamcorper. Aenean elit massa, luctus eu vestibulum vitae, gravida a augue. ';
                $product->price = str_replace(' ', '', str_replace('тг', '', $row[1]));
                $product->code = strtolower(str_replace(' ', '-', str_replace(',', '', $row[0])));
                $product->category_id = $category->id;

                $product->save();
                echo $product->name . 'added';
                $lineNumber++;
            }
      }

    }

}
