<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        $customerOrAdmin = auth()->user();
        if (!$customerOrAdmin)
            return false;
        return $customerOrAdmin->hasROle(['customer|admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255|unique:brands,name,' . $this->route('brand')->id,
            'description' => 'sometimes|string|max:255',
            'main_category_ids' => 'sometimes|array',
            'main_category_ids.*' => 'exists:main_categories,id'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        return throw new HttpResponseException($this->faildResponse($validator->errors(), 422));
    }
}
