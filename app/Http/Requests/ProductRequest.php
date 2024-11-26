<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:3',
            'description' => 'nullable|string',
            'store_id' => 'nullable|exists:stores,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image', // or 'nullable|image' if you expect an image file
            'status' => 'required|in:active,draft,archived',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'featured' => 'boolean',
            'rating' => 'nullable|numeric|min:0|max:5',
            'options' => 'nullable|json',
            'tags'=>'nullable|string'
       
        ];
    }
}
