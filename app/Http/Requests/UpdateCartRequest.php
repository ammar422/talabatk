<?php

namespace App\Http\Requests;

use App\Rules\CartElementBelongToAuthenticatedUser;
use App\Traits\ResponseTrait;
use Illuminate\Validation\Rule;
use App\Rules\LessThanOrEqualProductStock;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCartRequest extends FormRequest
{
    use ResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $adminOrCutomer = auth()->user();
        if (!$adminOrCutomer)
            return false;
        return $adminOrCutomer->hasRole(['customer|admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cart_element_id' => ['required', 'exists:carts,id', new CartElementBelongToAuthenticatedUser($this->cart_element_id)],
            'quantity' => ['required', 'integer', 'min:1', new LessThanOrEqualProductStock($this->cart_element_id)]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->faildResponse($validator->errors(), 422));
    }
}
