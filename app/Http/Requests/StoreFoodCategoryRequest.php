<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFoodCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'restaurant_categories_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'تمامی فیلد ها باید پر شوند',
            'string' => 'این فیلد باید حروف باشد'
        ];
    }
}
