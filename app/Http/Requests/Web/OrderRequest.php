<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class OrderRequest extends FormRequest
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
        $rules = [
            'shipping' => ['required', 'in:"Inside dhaka","Outside dhaka"'],
            'shipping_name' => ['required', 'string', 'max:255'],
            'shipping_email' => ['nullable', 'email'],
            'shipping_address_line' => ['required', 'string', 'max:255'],
            'reference_code' => ['nullable', 'string', 'max:255'],
            'shipping_district' => ['nullable', 'string', 'max:255'],
            'shipping_phone' => ['required', 'mobile'],
            'same_as_shipping' => ['nullable', 'boolean'],
            'transaction_type' => ['required', 'in:"Cash on delivery",Bkash,Rocket,Nogod'],
            /*'product_slug' => ['required', 'array'],
            'product_slug.*' => ['required', 'string', 'max:255', 'exists:products,slug'],
            'qty' => ['required', 'array'],
            'qty.*' => ['required', 'integer', 'min:1'],
            'product_color' => ['required', 'array'],
            'product_color.*' => ['nullable', 'string', 'max:255'],
            'product_size' => ['required', 'array'],
            'product_size.*' => ['nullable', 'string', 'max:255'],*/
        ];

        if (!$this->same_as_shipping) {
            $rules = array_merge($rules, [
                'billing_name' => ['required', 'string', 'max:255'],
                'billing_email' => ['nullable', 'email'],
                'billing_address_line' => ['required', 'string', 'max:255'],
                'billing_district' => ['required', 'string', 'max:255'],
                'billing_phone' => ['required', 'mobile'],
            ]);
        }

        return $rules;
    }
}
