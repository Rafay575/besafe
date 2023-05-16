<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FirePropertyActionData implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if ($value) {
            foreach ($value as $item) {
                if (count(array_keys($item)) > 5) {
                    $fail('only sno,action,timeline,description,status allowed');
                }
                if (!isset($item['sno']) or !is_numeric($item['sno'])) {
                    $fail(':attribute.sno is required and should be numeric');
                }
                if (!isset($item['action']) or !is_string($item['action'])) {
                    $fail(':attribute.action is required');
                }

                if (!isset($item['timeline']) or !is_string($item['timeline'])) {
                    $fail(':attribute.timeline is required');
                }

                if (!isset($item['status']) or !is_string($item['status'])) {
                    $fail(':attribute.status is required');
                }

                if (!isset($item['description']) or !is_string($item['description'])) {
                    $fail(':attribute.description is required');
                }
            }

        }

    }
}