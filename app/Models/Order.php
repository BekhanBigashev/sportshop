<?php

namespace App\Models;

use App\Services\TelegramService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function saveOrder($data){
        if ($this->status == 0){
            $this->name = $data['name'];
            $this->phone = $data['phone'];
            $this->email = $data['email'];
            $this->status = 1;
            $this->save();
            return true;
        }else{
            return false;
        }


    }
}
