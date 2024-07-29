<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryBoyWalletResource extends JsonResource
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
            'delivery-boy-id' => $this->deliveryBoy_id,
            'delivery-boy-name' => $this->deliveryBoy->name,
            'balance' => $this->balance
        ];
    }
}
