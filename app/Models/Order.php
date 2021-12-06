<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function totalPrice(){
        $sum = 0;
        foreach($this->products as $product){
            $sum += $product->priceForCount();
        }
        return $sum;
    }

    public function TotalCountOfProducts(){
        $count = 0;
        foreach($this->products as $product){
            $count += $product->pivot->count;
        }
        return $count;
    }
//    public function user(){
//        return $this->belongsTo(User::class);
//    }
    public function saveOrder($name, $phone){
        if ($this->status == 0){
            $this->name = $name;
            $this->phone = $phone;
            $this->status = 1;
            $this->save();
            return true;
        }else{
            return false;
        }


    }
}