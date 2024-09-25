<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $fillable = [
        'tickettype_id',
        'ticketsubtype_id',
        'description',
        'ticket_attachment',
        'requested_by',
        'assigned_to',
        'status',
        'current_level',
        'completed_at',
        'escalation_time_start'

    ];

    public static function getRouteName()
    {
        return 'employees.show'; //show route name
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tickettype()
    {
        return $this->belongsTo(TicketType::class, 'tickettype_id');
    }

    public function ticketsubtype()
    {
        return $this->belongsTo(TicketSubType::class, 'ticketsubtype_id');
    }

    public function requestedby()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function assignto()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'ticket_id');
    }

    public function feedback()
    {
        return $this->hasMany(TicketFeedback::class, 'ticket_id');
    }
    public function shouldEscalate()
    {
        $now = Carbon::now();

       
            $escalation_time_start = $this->escalation_time_start;
            $minutesSinceCreated = $this->getMinutesSinceCreatedDuringBusinessHours($escalation_time_start); 

            $subticketPriority =  $this->ticketsubtype->priority;
           
            $slaPolicy = SlaPolicy::first();

            if ($slaPolicy) {
                switch ($subticketPriority) {
                    case 'Urgent':
                        $resolutionTime = $slaPolicy->urgent_resolution_time;
                        break;
                    case 'High':
                        $resolutionTime = $slaPolicy->high_resolution_time;
                        break;
                    case 'Medium':
                        $resolutionTime = $slaPolicy->medium_resolution_time;
                        break;
                    case 'Low':
                        $resolutionTime = $slaPolicy->low_resolution_time;
                        break;
                    default:
                        $resolutionTime = null;
                }

               
                if ($minutesSinceCreated >= $resolutionTime) {
                    return true;
                }
                else{
                    return false;

                }
            }
        

    }
   
    public function getMinutesSinceCreatedDuringBusinessHours($createdAt)
    {
        $totalWorkingMinutes = 0;
        if (is_string($createdAt)) {
            $createdAt = Carbon::parse($createdAt);
        }
        $now = Carbon::now();

        $businessHours = BusinessHours::find(1);
        $workingDays = $businessHours->getWorkingDays(); 

        $currentDate = $createdAt->copy();

        while ($currentDate->lessThanOrEqualTo($now)) {
            $currentDay = strtolower($currentDate->format('l'));

            if (in_array($currentDay, $workingDays)) {
                $dayTimes = $businessHours->getStartEndTimesForDay($currentDay);
                $businessStartTime = Carbon::parse($dayTimes['start'])->setDate($currentDate->year, $currentDate->month, $currentDate->day);
                $businessEndTime = Carbon::parse($dayTimes['end'])->setDate($currentDate->year, $currentDate->month, $currentDate->day);

                if ($currentDate->isSameDay($createdAt)) {
                    if ($createdAt->between($businessStartTime, $businessEndTime)) {
                        $startTime = $createdAt;
                    } elseif ($createdAt->lessThan($businessStartTime)) {
                        $startTime = $businessStartTime;
                    } else {
                        $currentDate->addDay()->startOfDay();
                        continue;
                    }
                } else {
                    $startTime = $businessStartTime;
                }

                if ($currentDate->isSameDay($now)) {
                    $endTime = $now->lessThan($businessEndTime) ? $now : $businessEndTime;
                } else {
                    $endTime = $businessEndTime;
                }

                if ($startTime->lessThan($endTime)) {
                    $totalWorkingMinutes += $startTime->diffInMinutes($endTime);
                }
            }

            $currentDate->addDay()->startOfDay();
        }
      
        return $totalWorkingMinutes;
    }



}
