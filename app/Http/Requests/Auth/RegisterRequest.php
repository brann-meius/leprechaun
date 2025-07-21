<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'unique:users',
                'string',
                'regex:/^[A-Za-z.]+$/',
                'min:3',
                'max:32',
            ],
            'phone' => [
                'required',
                'unique:users',
                'regex:/^\+\d+$/',
                'string',
                'phone'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.phone' => 'The :attribute number isn\'t valid.',
        ];
    }
}
