<?php

namespace App\Http\Requests;


use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
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
            'image' => ['mimes:png,jpg,jpeg', 'max:20000', 'nullable'],
            'name' => ['required', 'string'],
            'days' => ['required', 'string'],
            'start' => ['required'],
            'end' => ['required'],
            'phone_number' => ['required', new PhoneNumber()],
            'account_number' => ['required']
        ];
    }
}
