<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest

// app/Http/Requests/RegisterRequest.php

{    public function authorize(): bool
    {
        return true; // Allow all users to register
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'unique:users,username',
                'regex:/^[a-zA-Z0-9_]+$/',
                'alpha_dash'
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'password_confirmation' => [
                'required',
                'string'
            ],
            'terms_accepted' => [
                'sometimes',
                'accepted'
            ]
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Username is required',
            'username.string' => 'Username must be a string',
            'username.min' => 'Username must be at least 3 characters long',
            'username.max' => 'Username must not exceed 30 characters',
            'username.unique' => 'This username is already taken',
            'username.regex' => 'Username can only contain letters, numbers, and underscores',
            'username.alpha_dash' => 'Username can only contain letters, numbers, dashes and underscores',
            
            'email.required' => 'Email address is required',
            'email.string' => 'Email must be a string',
            'email.email' => 'Please provide a valid email address',
            'email.max' => 'Email address must not exceed 255 characters',
            'email.unique' => 'This email address is already registered',
            
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            'password.min' => 'Password must be at least 8 characters long',
            'password.max' => 'Password must not exceed 255 characters',
            'password.confirmed' => 'Password confirmation does not match',
            
            'password_confirmation.required' => 'Password confirmation is required',
            'password_confirmation.string' => 'Password confirmation must be a string',
            
            'terms_accepted.accepted' => 'You must accept the terms and conditions'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'username' => 'username',
            'email' => 'email address',
            'password' => 'password',
            'password_confirmation' => 'password confirmation',
            'terms_accepted' => 'terms and conditions'
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                    'error_count' => $validator->errors()->count(),
                    'first_error' => $validator->errors()->first()
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'username' => $this->username ? strtolower(trim($this->username)) : null,
            'email' => $this->email ? strtolower(trim($this->email)) : null,
        ]);
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            // Check for common weak passwords
            $weakPasswords = ['password', '12345678', 'qwerty123', 'password123'];
            if (in_array(strtolower($this->password), $weakPasswords)) {
                $validator->errors()->add('password', 'This password is too common. Please choose a stronger password.');
            }

            // Additional username checks
            if ($this->username && strlen(str_replace(['_'], '', $this->username)) < 3) {
                $validator->errors()->add('username', 'Username must contain at least 3 alphanumeric characters');
            }
        });
    }

    /**
     * Get sanitized and validated data
     */
    public function getValidatedData(): array
    {
        return $this->only(['username', 'email', 'password']);
    }
}