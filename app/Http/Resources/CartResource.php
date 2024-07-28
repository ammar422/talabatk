<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id'=>$this->id,
            'user_id' => $this->user->id,
            'user' => $this->user->name,
            'product_id' => $this->product->id,
            'product' => $this->product,
            'quantity' => $this->quantity,
            'product_price' => $this->product->price,
            'quantity_price' => $this->product->price * $this->quantity
        ];
    }
}
