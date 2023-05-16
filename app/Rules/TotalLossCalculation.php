<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TotalLossCalculation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $directLossValue = request('loss_calculation.direct_loss.value');
        $indirectLossValue = request('loss_calculation.indirect_loss.value');
        $totalLossValue = ($directLossValue + $indirectLossValue);
        if ($totalLossValue != $value) {
            $fail('The :attribute must equal to the sum of direct and indirect cost.');
        }

    }

}