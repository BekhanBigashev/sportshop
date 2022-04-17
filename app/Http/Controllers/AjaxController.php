<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AjaxController extends Controller
{
    public function basketAdd($product_id)
    {
        Order::addToBasket($product_id);
        $product = Product::find($product_id);

        return Response::json(['name' => $product->name], 200);
    }

    function getBasketCount()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::find($orderId);
            $count = $order->TotalCountOfProducts();
        } else {
            $count = 0;
        }
        return Response::json(['count' => $count]);
    }
}
