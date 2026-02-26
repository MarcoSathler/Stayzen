<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'role' => ['required', Rule::in(['seller', 'customer', 'admin'])],

        ];
    }

    public function messages(): array
    {
        return [
        ];
    }

    public function validated($key = null, $default = null)
    {
        return parent::validated($key, $default);
    }
}
