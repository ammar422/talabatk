<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreDeliveryBoyRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:delivery_boys,email'],
            'phone' => ['required', 'string', 'max:15', 'unique:delivery_boys,phone'],
            'image' => ['image' , 'mimes:png,jpg,jpeg' , 'max:2048'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->faildResponse($validator->errors(), 422));
    }
}
