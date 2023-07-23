<?php

namespace App\Rules;

use App\Models\MetaLocation;
use App\Models\MetaUnit;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MetaLocationValidate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $meta_unit_id = request('meta_unit_id');
        $meta_location_id = request('meta_location_id');
        if (!$meta_unit_id) {
            $fail('Please provide valid unit');
            return;
        }

        $unit = MetaUnit::where('id', $meta_unit_id)->first();
        $location = MetaLocation::where('id', $meta_location_id)->first();
        if (!$location) {
            $fail("The location is not valid.");
        }
        if (!$unit) {
            $fail("The unit is not valid.");
        }
        $unit_location = MetaLocation::where('id', $meta_location_id)->where('meta_unit_id', $meta_unit_id)->first();
        if (!$unit_location) {

            $fail("The location {$location->location_title} is not associated with {$unit->unit_title}.");
        }

    }
}