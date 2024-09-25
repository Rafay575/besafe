<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'name',
        'description',
        'timezone',
        'businesshourstype',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'monday_start',
        'monday_end',
        'tuesday_start',
        'tuesday_end',
        'wednesday_start',
        'wednesday_end',
        'thursday_start',
        'thursday_end',
        'friday_start',
        'friday_end',
        'saturday_start',
        'saturday_end',
        'sunday_start',
        'sunday_end',
    ];
    
    public function getWorkingDays()
    {
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    
        $workingDays = [];
    
        foreach ($daysOfWeek as $day) {
            if ($this->{$day} === 'on') { // Check if the column value is 'on'
                $workingDays[] = $day; // Add the day to the array with capitalized first letter
            }
        }
    
        return $workingDays;
    }
    public function getStartEndTimesForDay($currentDay)
    {
        // Prepare the start and end column names dynamically
        $startColumn = "{$currentDay}_start";
        $endColumn = "{$currentDay}_end";
    
        // Fetch the times from the database using the dynamic column names
        $dayTimes = [];
        $dayTimes['start'] = $this->$startColumn;
        $dayTimes['end'] = $this->$endColumn;
    
        return $dayTimes;
    }
    
}
