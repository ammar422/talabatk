<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBrandRequest extends FormRequest
{
    use ResponseTrait;
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
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'required|string|max:255',
            'main_category_ids' => 'required|array',
            'main_category_ids.*' => 'exists:main_categories,id'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        return throw new HttpResponseException($this->faildResponse($validator->errors(), 422));
    }
}
