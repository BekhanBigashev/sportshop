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
        $context = [];
        $context['newProducts'] = Product::orderBy('created_at', 'desc')->limit(8)->get();
        if ($orderId = session()->get('afterCheckoutOrderId')) {
            $order = Order::find($orderId);
/*            dd($order->relatedProducts());*/
            $context['afterCheckoutOrder'] = $order->relatedProducts();
        } else {
            $context['afterCheckoutOrder'] = false;
        }
        return view('index', $context);
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

    public function test()
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.paybox.money/init_payment.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('pg_order_id' => '140', 'pg_merchant_id' => '543847', 'pg_amount' => '1500', 'pg_description' => 'Оплата заказа', 'pg_salt' => 'some random string', 'pg_sig' => 'e8d9885b6431b9bef3e29142dd6da8d0'),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }
}
