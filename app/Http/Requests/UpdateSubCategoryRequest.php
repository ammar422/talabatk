<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateSubCategoryRequest extends FormRequest
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
            'name'              => ['sometimes', 'string', 'max:255', 'unique:sub_categories,name'],
            'description'       => ['nullable', 'string', 'max:255'],
            'main_category_id'  => ['sometimes', 'exists:main_categories,id']
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'this sub-category already exists',
            'main_category_id.exists' => 'this main category id is not found in main category table'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->faildResponse($validator->errors(), 422));
    }
}
