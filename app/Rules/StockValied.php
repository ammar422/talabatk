<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class StockValied implements Rule
{
    protected $product_id;
    public function __construct($product_id)
    {
        $this->product_id = $product_id;
    }


    public function passes($attribute, $value)
    {
        $product = Product::find($this->product_id);
        if (!$product)
            return true;
        return $value <= $product->stock;
    }
    public function message()
    {
        return 'The quantity must be less than or equal to the product stock.';
    }
}
