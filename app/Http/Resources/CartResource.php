<?php

namespace App\Http\Resources;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'restaurant' => [
                'name' => $this->restaurant->name,
                'image' => $this->restaurant->image,
                'address' => $this->restaurant->address,
                'orders' => OrderResource::collection($this->orders)
            ],
            'total_price' => $this->total_price
        ];
    }
}
