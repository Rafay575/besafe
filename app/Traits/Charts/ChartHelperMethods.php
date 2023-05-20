<?php
namespace App\Traits\Charts;

use Carbon\Carbon;

trait ChartHelperMethods
{
    public static function daysNameInMonth($datesInMonth)
    {
        if (count($datesInMonth) > 0)
            $daysNames = [];
        foreach ($datesInMonth as $date) {
            $daysNames[] = substr(Carbon::parse($date)->format('l'), 0, 3); //this is where we split day name and get the first letter
        }

        return $daysNames;
    }

    public static function datesInMonth($date = null)
    {
        $datesArray = [];
        if (!empty($date)) {
            $parsedDate = Carbon::parse($date);
        } else {
            $parsedDate = Carbon::now();
        }

        for ($i = 1; $i <= $parsedDate->daysInMonth; $i++) {
            $date = $i . '-' . $parsedDate->month . '-' . $parsedDate->year;
            $datesArray[] = Carbon::parse($date)->format('Y-m-d');
        }

        return $datesArray;
    }

}