<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function restaurantCategory(): BelongsTo
    {
        return $this->belongsTo(RestaurantCategory::class, 'restaurant_categories_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class, 'restaurant_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'restaurant_id');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'restaurant_id');
    }

    public function comments(): HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, Cart::class, 'restaurant_id', 'cart_id');
    }
}
