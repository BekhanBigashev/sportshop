<?php

namespace App\Http\Controllers;
use App\Models\DeliveryPoint;
use App\Models\Order;
use App\Models\Product;
use App\Services\B24Service;
use App\Services\PayBoxApiService;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Monolog\Handler\TelegramBotHandler;
use App\Services\TelegramService;
class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }else{
            $order = false;
        }
        return view('basket', compact('order'));
    }

    public function basketConfirm(Request $request){
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $validated = $request->validate(['name' => 'required|min:4|max:25','email' => 'required|email',
            'phone' => 'required','delivery' => 'required|in:pickup,delivery',
            'delivery_point_id' => 'nullable','adress' => 'nullable|min:5|max:25','comment' => 'nullable|min:5|max:200',
        ]);
        $order = Order::find($orderId);
        $success = $order->saveOrder($validated);
        if ($success){
            session()->forget('orderId');
            session()->flash('success', 'Ваш заказ успешно оформлен');
            session(['afterCheckoutOrderId' => $orderId]);
            foreach ($order->products as $product) {
                $product->available_items_count -= $product->pivot->count;
                $product->save();
            }
        }else{
            session()->flash('warning', 'Произошла ошибка при сохранении заказа');
        }


        return redirect()->route('index');
    }

    public function basketPlace()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        $deliveryPoints = DeliveryPoint::all();
        return view('order', ['order' => $order, 'deliveryPoints' => $deliveryPoints]);
    }

    public function basketAdd($product_id)
    {
        Order::addToBasket($product_id);
        $product = Product::find($product_id);
        session()->flash('success', 'Добавлен товар '. $product->name);
        return redirect()->back();
    }

    public function basketRemove($product_id)
    {
        $orderId = session('orderId');
        $order = Order::find($orderId);
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        if ($order->products->contains($product_id)) {
            $pivotRow = $order->products()->where('product_id', $product_id)->first()->pivot;
            if ($pivotRow->count < 2){
                $order->products()->detach($product_id);

            }else{
                $pivotRow->count--;
                $pivotRow->update();

            }

        }
        $order = Order::find($orderId);
        $count = $order->products->count();
        if ($count == 0) {
            session()->forget('orderId');
        }
        $product = Product::find($product_id);
        session()->flash('notice', 'Удален товар '. $product->name);
        return redirect()->back();
    }


}
