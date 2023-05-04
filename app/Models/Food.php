<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'image',
        'name',
        'price',
        'material',
        'discounted_price',
        'food_party_price',
        'food_categories_id',
        'restaurant_id'
    ];

    public function foodCategory(): BelongsTo
    {
        return $this->belongsTo(FoodCategory::class, 'food_categories_id');
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
