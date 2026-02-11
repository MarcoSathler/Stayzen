<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginAuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    /**
     * Validar credenciais após validação básica
     */
    protected function passedValidation(): void
    {
        $user = User::where('email', $this->email)->where('is_deleted', 0)->first();

        if (!$user || !Hash::check($this->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['E-mail or password incorrect'],
            ]);
        }

        $this->merge(['user' => $user]);
    }

    /**
     * Dados validados + user
     */
    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated($key, $default), $this->all());
    }
}
