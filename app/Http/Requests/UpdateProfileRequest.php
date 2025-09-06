<?php
// app/Http/Requests/UpdateProfileRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = auth()->id() ?? $this->user()->id ?? null;

        return [
            'username' => [
                'sometimes',
                'string',
                'min:3',
                'max:30',
                Rule::unique('users', 'username')->ignore($userId),
                'regex:/^[a-zA-Z0-9_]+$/'
            ],
            'email' => [
                'sometimes',
                'string',
                'email:rfc,dns',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId)
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'username.min' => 'Username must be at least 3 characters long',
            'username.max' => 'Username must not exceed 30 characters',
            'username.unique' => 'This username is already taken',
            'username.regex' => 'Username can only contain letters, numbers, and underscores',
            
            'email.email' => 'Please provide a valid email address',
            'email.max' => 'Email address must not exceed 255 characters',
            'email.unique' => 'This email address is already registered'
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

    protected function prepareForValidation(): void
    {
        $this->merge([
            'username' => $this->username ? strtolower(trim($this->username)) : null,
            'email' => $this->email ? strtolower(trim($this->email)) : null,
        ]);
    }
}