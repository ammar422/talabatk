<?php

namespace App\Http\Requests;

use App\Rules\VendorExists;
use App\Rules\MainCategoryExists;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProductRequest extends FormRequest
{
    use ResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        $adminOrVendor = auth()->user();
        if (!$adminOrVendor)
            return
                false;
        return $adminOrVendor->hasRole(['admin|vendor']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric',
            'stock' => 'sometimes|integer',
            'size' => 'nullable|string|max:255',
            'sub_category_id' => 'sometimes|exists:sub_categories,id',
            'main_category_id' => ['sometimes', 'exists:main_categories,id', new MainCategoryExists($this->sub_category_id)],
            'vendor_id' => ['sometimes', 'exists:vendors,id', new VendorExists($this->sub_category_id)],
            'brand_id' => 'nullable|exists:brands,id',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->faildResponse($validator->errors(), 422));
    }
}
