<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'age' => 'nullable|integer|min:18',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,manager',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
