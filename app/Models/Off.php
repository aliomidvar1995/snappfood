<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Off extends Model
{
    use HasFactory;

    protected $fillable = [
        'off',
        'food_categories_id'
    ];

    public function foodCategory(): BelongsTo
    {
        return $this->belongsTo(FoodCategory::class, 'food_categories_id');
    }
}
