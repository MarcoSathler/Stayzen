<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'check_in' => ['required', 'date'],
            'check_out' => ['required', 'date'],
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

    public function getAccommodation()
    {
        return $this->route('accommodation');
    }
}
