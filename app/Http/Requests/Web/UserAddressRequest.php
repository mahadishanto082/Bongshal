<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'address_type' => ['required', 'in:primary,billing,shipping'],
            'address_line' => ['required', 'string', 'max:255'],
            'district' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'mobile'],
            'is_default' => ['nullable', 'boolean'],
        ];
    }
}
