<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestaurantCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function foodCategories(): HasMany
    {
        return $this->hasMany(FoodCategory::class, 'restaurant_categories_id');
    }

    public function restaurants(): HasMany
    {
        return $this->hasMany(Restaurant::class);
    }
}
