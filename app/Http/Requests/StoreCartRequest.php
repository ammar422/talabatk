<?php

namespace App\Http\Requests;

use App\Rules\StockValied;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreCartRequest extends FormRequest
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
            'product_id' => ['required', 'exists:products,id', Rule::unique('carts')->where(fn ($qr) => $qr->where('user_id', auth()->id()))],
            'quantity' => ['required', 'integer', 'min:1', new StockValied($this->product_id)]
        ];
    }
    public function messages()
    {
        return [

            'product_id.unique' => 'this product is already exist , It is not possible to add twice, you can increase the quantity'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->faildResponse($validator->errors(), 422));
    }
}
