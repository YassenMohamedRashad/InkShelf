<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
