<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'food_name' => $this->food->name,
            'food_count' => $this->count,
            'price' => $this->food->food_party_price,
            'total_price' => $this->total_price
        ];
    }
}
