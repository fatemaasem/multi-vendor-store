<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ContainsWord implements ValidationRule
{ private string $word;

    /**
     * Create a new rule instance.
     *
     * @param  string  $word  The word that must be contained in the value
     * @return void
     */
    public function __construct(string $word)
    {
        $this->word = $word; // Store the word to check for
    }

    /**
     * Validate the attribute value.
     *
     * @param  string  $attribute  The name of the attribute being validated
     * @param  mixed  $value  The value of the attribute being validated
     * @param  Closure  $fail  A callback to invoke if validation fails
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the value contains the specified word
        if (!str_contains($value, $this->word)) {
            // If not, invoke the callback with an error message
            $fail("The $attribute must contain the word '{$this->word}'.");
        }
    }
}
