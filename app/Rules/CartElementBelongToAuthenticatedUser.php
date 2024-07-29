<?php

namespace App\Rules;

use App\Models\Cart;
use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;

class CartElementBelongToAuthenticatedUser implements Rule
{
    use ResponseTrait;
    protected $cart_element_id;
    public function __construct($cart_element_id)
    {
        $this->cart_element_id = $cart_element_id;
    }


    public function passes($attribute, $value)
    {
        return Cart::where('id', $this->cart_element_id)->where('user_id', auth()->id())->first();
    }
    public function message()
    {
        throw new HttpResponseException($this->faildResponse('Unauthorized user', 401));
    }
}
