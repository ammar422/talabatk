<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMainCategoryRequest extends FormRequest
{
    use ResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $admin = auth('admin')->user();
        if ($admin) {
            return $admin->hasRole('admin');
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'name' => 'required|string|max:255|unique:main_categories,name,except,id',
            'name' => 'required|string|max:255|unique:main_categories,name',
            'description' => 'required|string|max:255',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response =  $this->faildResponse($validator->errors(), 422);

        throw new HttpResponseException($response);
    }
}
