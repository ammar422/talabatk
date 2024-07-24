<?php

namespace App\Http\Requests;

use App\Rules\MainCategoryExists;
use App\Rules\VendorExists;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|max:2048',
            'size' => 'nullable|string|max:255',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'main_category_id' => ['required', 'exists:main_categories,id', new MainCategoryExists($this->sub_category_id)],
            'vendor_id' => ['required', 'exists:vendors,id', new VendorExists($this->sub_category_id)],
            'brand_id' => 'nullable|exists:brands,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->faildResponse($validator->errors(), 422));
    }
}