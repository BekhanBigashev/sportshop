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
        return $this->price * $count;
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

    /**
     * Рейтинг товара (среднее всех его отзывов)
     * @return float
     */
    public function rating()
    {
        return round(collect($this->reviews)->avg('score'),0, PHP_ROUND_HALF_UP);
    }

    /**
     * Количество заказанных экземпляров этого товара (не работает)
     * @return false|string
     */
/*    public function countOfOrders()
    {
        return json_encode(DB::select('select SUM(count) as count from order_product inner join orders on orders.id=order_product.order_id where orders.status=1 and product_id='.$this->id ));
    }*/

    public function related()
    {
        $relatedCategories = Category::RELATIONS[$this->category_id];
/*        foreach ($relatedCategories as $category) {
            $builder = self::where('category_id', $category)->limit(2);
            $res += $builder;
        }
        dd($res->get());*/
        $builder = self::whereIn('category_id', $relatedCategories)->limit(4)->whereBetween('price', [($this->price - 10000), ($this->price + 10000)])->inRandomOrder()->get();
/*        dd($builder);*/
        return $builder;
    }
}
