<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
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
}
