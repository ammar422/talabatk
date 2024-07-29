<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateDeliveryBoyRequest extends FormRequest
{
    use ResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $admin = auth('admin')->user();
        if (!$admin)
            return false;
        return $admin->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'unique:delivery_boys,email,' . $this->route('delivery_boy')->id],
            'phone' => ['sometimes', 'string', 'max:15', 'unique:delivery_boys,phone,' . $this->route('delivery_boy')->id],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->faildResponse($validator->errors(), 422));
    }
}
