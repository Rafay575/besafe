<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MetaPersonValidate implements ValidationRule
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
                if (count(array_keys($item)) > 7) {
                    $fail('only sno,employee_id,name,department,designation,contact_no,health_status are allowed');
                }
                if (!isset($item['sno']) or !is_numeric($item['sno'])) {
                    $fail(':attribute.sno is required and should be numeric');
                }
                if (!isset($item['employee_id']) or !is_string($item['employee_id'])) {
                    $fail(':attribute.employee_id is required');
                }

                if (!isset($item['name']) or !is_string($item['name'])) {
                    $fail(':attribute.name is required');
                }
                if (!isset($item['department']) or !is_string($item['department'])) {
                    $fail(':attribute.department is required');
                }
                if (!isset($item['designation']) or !is_string($item['designation'])) {
                    $fail(':attribute.designation is required');
                }
                if (!isset($item['contact_no']) or !is_string($item['contact_no'])) {
                    $fail(':attribute.contact_no is required');
                }
                if (!isset($item['health_status']) or !is_string($item['health_status'])) {
                    $health_statuses = ['healthy', 'injured', 'Healthy', 'Injured'];
                    if (!in_array($item['health_status'], $health_statuses)) {
                        $fail(':attribute.health_status value can only be either healthy or injured');
                    }
                    $fail(':attribute.health_status is required');

                }


            }

        }
    }
}