<?php

namespace App\Http\Requests;

use App\Rules\ContainsWord;
use App\Rules\Filter;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $id=$this->route('category');
        
        return [
            'username'=>["required",
            "min:3",
            "max:15",
            "string",
            "unique:categories,name,$id",
            'count_words:1',
            new Filter(['forbidden', 'banned', 'restricted']),//add custom validation to restrict specific words
            
        ],
            'parent_cat_id'=>'int|nullable|exists:categories,id',
            'description'=>'required|min:7',
            'status'=>'in:active,archived',
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
