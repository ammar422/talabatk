<?php

namespace App\Rules;

use App\Models\Cart;
use Illuminate\Contracts\Validation\Rule;

class LessThanOrEqualProductStock implements Rule
{
    protected $product;
    protected $cart_element_id;

    public function __construct($cart_element_id)
    {
        $this->cart_element_id = $cart_element_id;
    }

    public function passes($attribute, $value)
    {
        $cartElement = Cart::find($this->cart_element_id);
        if ($cartElement) {
            $this->product = $cartElement->product;
            return $value <= $this->product->stock;
        }
        return false;
    }

    public function message()
    {
        return 'The quantity must be less than or equal to the product stock.';
    }
}
