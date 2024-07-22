<?php

namespace App\Http\Requests;

use App\Rules\MainCategoryExists;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateVendorRequest extends FormRequest
{
    use ResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $vendor = auth('admin')->user();
        if (!$vendor) {
            return false;
        }
        return $vendor->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255|unique:vendors,name,' . $this->route('vendor')->id,
            'address' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:vendors,email,' . $this->route('vendor')->id,
            'password' => 'sometimes|string|min:8',
            'sub_category_id' => 'sometimes|exists:sub_categories,id',
            'main_category_id' => ['sometimes', new MainCategoryExists($this->sub_category_id)],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->faildResponse($validator->errors(), 422));
    }
}
