<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;


    /**
     * Категория товара
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Цена товара в заказе учитывая его количество
     * @return float|int
     */
    public function priceForCount()
    {
        $count = $this->pivot->count;
        return $this->getPrice() * $count;
    }

    /**
     * Отзывы товара
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Количество отзывов товара
     * @return int
     */
    public function reviewsCount(): int
    {
        return collect($this->reviews)->count();
    }

    /**
     * Проверяет есть ли товар в корзине
     * @return bool
     */
    public function existInBasket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            return Order::find($orderId)->products->contains($this->id);
        }
        return false;

    }

    public function getPrice()
    {
        return is_null($this->sale) ? $this->price : $this->price - ($this->price * ($this->sale/100));
    }

    /**
     * Рейтинг товара (среднее всех его отзывов)
     * @return float
     */
    public function rating()
    {
        return round(collect($this->reviews)->avg('score'),0, PHP_ROUND_HALF_UP);
    }


    public function related($count = 2)
    {
        $relatedCategories = Category::RELATIONS[$this->category_id];
        foreach ($relatedCategories as $category) {
            $builder = self::where('category_id', $category)->limit($count)->whereBetween('price', [($this->getPrice() / 2), ($this->getPrice() + 1000)])->get();
            foreach ($builder as $item) {
                $res[] = $item;
            }
        }
        return $res ?? false;
    }
}
