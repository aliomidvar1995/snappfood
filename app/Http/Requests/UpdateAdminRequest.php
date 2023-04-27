<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAdminRequest extends FormRequest
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
        $id = Auth::id();
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,$id"],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required']
        ];
    }

    public function messages(): array
    {
        $id = Auth::id();
        return [
            'required' => 'تمام فیلد ها باید پر شوند',
            'max:255' => 'حداکثر تعداد کاراکتر های مجاز برای این فیلد 255 می باشد',
            'min:8' => 'حداقل تعداد کاراکتر برای این فیلد 8 می باشد',
            "unique:users,email,$id" => 'ایمیل تکراری می باشد',
            'email' => 'ورودی باید ایمیل معتبر باشد',
            'string' => 'ورودی باید حروف باشد',
            'confirmed' => 'این فیلد باید دقیقا رمز عبور وارد شده باشد'
        ];
    }
}
