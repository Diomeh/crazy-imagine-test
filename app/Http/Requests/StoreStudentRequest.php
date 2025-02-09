<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;


/**
 * A custom request class that handles access and data validation
 * when both creating and updating a student entity.
 *
 * In a more complex scenario, create and update would live in
 * their own separate classes, but logic is simple enough to not warrant it
 */
class StoreStudentRequest extends FormRequest
{
    /**
     * We always authorize access to student entity
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Please provide the first name.',
            'last_name.required' => 'Please provide the last name.',
            'address.max' => 'The address is too long.',
        ];
    }
}
