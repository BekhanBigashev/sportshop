<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Товары в данной категории
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(){
        return $this->hasMany(Product::class);
    }

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
