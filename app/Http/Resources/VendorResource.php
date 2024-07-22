<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'email' => $this->email,
            'image'         => $this->image,
            'main-category' => $this->mainCategory,
            'sub_category_id' => $this->subCategory,
        ];
    }
}
