<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\TelegramService;
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

    public function getBasketCount()
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

    public function deleteOrder($orderId)
    {
        Order::destroy($orderId);
        return Response::json(['success' => true]);
    }

    public function updateUser(Request $request, $userId)
    {
        TelegramService::send(print_r($request->all()));
        User::find($userId)->update($request->toArray());
        return Response::json(['success' => true]);
    }

}
