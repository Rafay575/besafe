<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PtwActionData implements ValidationRule
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
                if (count(array_keys($item)) > 6) {
                    $fail('only sno,action,responsible,target_date,actual_completion,remarks allowed');
                }
                if (!isset($item['sno']) or !is_numeric($item['sno'])) {
                    $fail(':attribute.sno is required and should be numeric');
                }
                if (!isset($item['action']) or !is_string($item['action'])) {
                    $fail(':attribute.action is required');
                }

                if (!isset($item['responsible']) or !is_string($item['responsible'])) {
                    $fail(':attribute.responsible is required');
                }

                if (!isset($item['target_date']) or !is_string($item['target_date']) or !strtotime($item['target_date'])) {
                    $fail(':attribute.target_date is required and should be date');
                }

                if (!isset($item['actual_completion']) or !is_string($item['actual_completion'])) {
                    $fail(':attribute.actual_completion is required');
                }

                if (!isset($item['remarks']) or !is_string($item['remarks'])) {
                    $fail(':attribute.remarks is required');
                }
            }

        }

    }
}