<?php

declare(strict_types=1);

namespace App\Features\Registration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $raw = (string) $this->input('phone_number', '');
        $normalized = preg_replace('/\D+/', '', $raw);
        $this->merge(['phone_number' => $normalized]);
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:100', 'unique:users,username'],
            'phone_number' => ['required', 'string', 'max:32', 'unique:users,phone_number'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.unique' => 'User with this username already exists.',
            'phone_number.unique' => 'User with this phone number already exists.',
        ];
    }
}
