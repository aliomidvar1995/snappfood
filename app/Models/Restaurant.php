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

    protected $fillable = [
        'image',
        'name',
        'days',
        'start',
        'end',
        'phone_number',
        'latitude',
        'longitude',
        'account_number',
        'user_id',
        'restaurant_categories_id',
        'address'
    ];

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
}
