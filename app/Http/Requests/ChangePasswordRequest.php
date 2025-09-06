<?php
// app/Http/Requests/ChangePasswordRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => [
                'required',
                'string'
            ],
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'different:current_password',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'new_password_confirmation' => [
                'required',
                'string'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Current password is required',
            'new_password.required' => 'New password is required',
            'new_password.min' => 'New password must be at least 8 characters long',
            'new_password.confirmed' => 'New password confirmation does not match',
            'new_password.different' => 'New password must be different from current password',
            'new_password_confirmation.required' => 'New password confirmation is required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            // Check if new password is same as current
            if ($this->current_password === $this->new_password) {
                $validator->errors()->add('new_password', 'New password must be different from current password');
            }

            // Check for weak passwords
            $weakPasswords = ['password', '12345678', 'qwerty123', 'password123'];
            if (in_array(strtolower($this->new_password), $weakPasswords)) {
                $validator->errors()->add('new_password', 'This password is too common. Please choose a stronger password.');
            }
        });
    }
}