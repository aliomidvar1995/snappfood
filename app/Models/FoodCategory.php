<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FoodCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'restaurant_categories_id'
    ];

    public function restaurantCategory(): BelongsTo
    {
        return $this->belongsTo(RestaurantCategory::class, 'restaurant_categories_id');
    }

    public function off(): HasOne
    {
        return $this->hasOne(Off::class);
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }
}
