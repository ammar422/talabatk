<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class LessThanOrEqualProductStock implements Rule
{
    protected $product;
    protected $product_id;

    public function __construct($product_id)
    {
        $this->product_id = $product_id;
    }
    
    public function passes($attribute, $value)
    {
        $this->product = Product::find($this->product_id);
        return $value <= $this->product->stock;
    }

    public function message()
    {
        return 'The quantity must be less than or equal to the product stock.';
    }
}
