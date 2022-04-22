<?php

namespace App\Models;

use App\Services\TelegramService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    /**
     * Товары в заказе
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    /**
     * Общая цена заказа
     * @return int
     */
    public function totalPrice(){
        $sum = 0;
        foreach($this->products as $product){
            $sum += $product->priceForCount();
        }
        return $sum;
    }

    /**
     * Количество товаров в заказе
     * @return int
     */
    public function TotalCountOfProducts(){
        $count = 0;
        foreach($this->products as $product){
            $count += $product->pivot->count;
        }
        return $count;
    }

    /**
     * Сохранение заказа
     * @param $name
     * @param $phone
     * @return bool
     */
    public function saveOrder($validated){
        if ($this->status == 0){
            $this->name = $validated['name'];
            $this->phone = $validated['phone'];
            $this->email = $validated['email'];
            $this->status = 1;
            $this->delivery = $validated['delivery'];
            if(!is_null($validated['comment'])) {
                $this->comment = $validated['comment'];
            }

            if ($validated['delivery'] == 'pickup') {
                $this->delivery_point_id = $validated['delivery_point_id'];
            } elseif ($validated['delivery'] == 'delivery') {
                $this->adress = $validated['adress'];
            } else {
                return false;
            }
            if (Auth::user()) {
                $this->user_id = Auth::id();
            }

            $this->save();
            return true;
        }else{
            return false;
        }


    }

    public static function addToBasket($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = self::create();
            session(['orderId' => $order->id]);
        }else{
            $order = self::find($orderId);
        }
        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        }else{
            $order->products()->attach($productId);
        }
    }

    public function getDeliveryPoint()
    {
        return DeliveryPoint::find($this->delivery_point_id);
    }

    public function relatedProducts()
    {

        $orderProducts = $this->products;

        foreach ($orderProducts as $product) {
            $related = Product::where('category_id', $product->category_id)->where('id', '!=',  $product->id)->limit(2)->get();
            foreach ($related as $item) {
                $res[] = $item;
            }
        }
        return $res;
    }
}
