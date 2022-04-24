<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;

    public const RELATIONS = [
        5 => [9, 7, 14, 15],
        7 => [5, 9, 14, 15],
        9 => [7, 14],
        14 => [7, 9],
        15 => [16, 5],
        16 => [15, 5],
        8 => [22, 23],
        11 => [12, 13],
        12 => [11, 13],
        13 => [11, 12],
        19 => [20],
        20 => [19],
        21 => [23, 22],
        22 => [21, 23],
        23 => [22, 21, 8],
    ];
    /**
     * Товары в данной категории
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(){
        return $this->hasMany(Product::class)->whereNot('available_items_count', 0)->get();
    }

/*    public function availableProducts()
    {

    }*/
    /**
     * Возвращение родительской категории
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(){
        return $this->belongsTo(static::class, 'parent_id');
    }

    /**
     * Возвращение дочерней категории
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrens(){
        return $this->hasMany(static::class, 'parent_id');
    }
}
