<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

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
     * Рейтинг товара (среднее всех его отзывов)
     * @return float
     */
    public function rating()
    {
        return round(collect($this->reviews)->avg('score'),0, PHP_ROUND_HALF_UP);
    }
}
