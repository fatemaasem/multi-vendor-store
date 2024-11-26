<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    protected $forbidden;
    public function __construct($forbidden)
    {
        $this->forbidden=$forbidden;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        if(in_array(strtolower($value),$this->forbidden)){
            $value=ucfirst($value);
            $fail("The :attribute can not be $value");
            }
        }
            
}
