<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResorce extends JsonResource
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
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $this->image,
            'size' => $this->size,
            'sub-category name' => $this->subCategory->name,
            'main_category_id' => $this->mainCategory->name,
            'vendor' => new VendorResource($this->vendor),
            'brand' => $this->brand,
        ];
    }
}
