<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket(){
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
        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);

        if ($success){
            session()->forget('orderId');
            session()->flash('success', 'Ваш заказ успешно оформлен');
        }else{
            session()->flash('warning', 'При обработке заказа произошла ошибка');
        }
        return redirect()->route('index');
    }
    public function basketPlace(){
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        return view('order', compact('order'));
    }

    public function basketAdd($product_id){

        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        }else{
            $order = Order::find($orderId);
        }
        if ($order->products->contains($product_id)){
            $pivotRow = $order->products()->where('product_id', $product_id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        }else{
            $order->products()->attach($product_id);
        }
        $product = Product::find($product_id);
        session()->flash('success', 'Добавлен товар '. $product->name);
        return redirect()->route('basket');

    }

    public function basketRemove($product_id){
        $orderId = session('orderId');
        $order = Order::find($orderId);
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        if ($order->products->contains($product_id)){
            $pivotRow = $order->products()->where('product_id', $product_id)->first()->pivot;
            if ($pivotRow->count < 2){
                $order->products()->detach($product_id);
            }else{
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        $product = Product::find($product_id);
        session()->flash('notice', 'Удален товар '. $product->name);
        return redirect()->route('basket');



    }
}
