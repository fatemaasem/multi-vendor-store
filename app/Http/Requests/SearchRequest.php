<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'name'=>'nullable|string|max:255', // 'name' is not required, should be a string if present
           'status' => ['nullable',
           function($attribute, $value, $fail){
            $validStatus=['active','archived'];
                if($this->page=='product')
                    $validStatus=['active','archived','draft'];
             // Check if the status is in the valid statuses
             if (!in_array($value, $validStatus)) {
                $fail("The {$attribute} must be one of the following: " . implode(', ', $validStatus));
            }
           }, // Validates against an array of valid statuses
           ]
        ];
    }
   

   
}
