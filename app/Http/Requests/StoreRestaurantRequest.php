<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
            'phone_number' => ['required', new PhoneNumber()],
            'account_number' => ['required']
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
