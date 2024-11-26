<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'f_name' => 'required|string|max:255',
            's_name' => 'required|string|max:255',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'required|string|size:2', // Assuming ISO country codes (2 characters)
            'postal_code' => 'nullable|string|max:10',
            'lang' => 'nullable|string|max:5', // Assuming language codes like 'en', 'fr', etc.
            'gender' => 'required|in:male,female',
        ];
    }
}
