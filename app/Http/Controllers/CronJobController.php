<?php

namespace App\Http\Controllers;

use DB;
use DateTime;
use DateInterval;
use DatePeriod;
use Carbon\Carbon;
use App\Models\Grade;
use App\Models\Ticket;
use App\Models\Employee;
use App\Models\User;
use App\Models\Comment;
use App\Models\TicketTimeline;
use App\Models\TicketSetting;
use App\Models\BusinessHours;
use App\Models\SlaPolicy;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;

class CronJobController extends Controller
{

    public function ticket_escalation_level()
    {

        $businessHours      = BusinessHours::first();
        $tz_name            = explode(" ", $businessHours->timezone);
        date_default_timezone_set($tz_name[0]);
        $slapolicy          = SlaPolicy::first();
        $todayweekday       = strtolower(date('l'));
        $currentTime        = date('H:i');
        $isworkingday       = $businessHours->{$todayweekday};
        $workingdaystart    = $businessHours->{$todayweekday . '_start'};
        $workingdayend      = $businessHours->{$todayweekday . '_end'};

        if ($businessHours->businesshourstype == "custom" && $isworkingday == "on") {
            
            if ($currentTime >= $workingdaystart && $currentTime <= $workingdayend) {

                $tickettimelines = $latestTicketTimelines = TicketTimeline::select('*')
                                ->whereIn('id', function ($query) {
                                    $query->select(DB::raw('MAX(id)'))
                                        ->from('ticket_timelines')
                                        ->groupBy('ticket_id');
                                })
                                ->orderBy('created_at', 'desc')
                                ->get();

                foreach ($tickettimelines as $key => $tickettimeline) {

                    $days               = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                    $ticket             = $tickettimeline->ticket;
                    $ticketsubtype      = $ticket->ticketsubtype;
                    $priority           = strtolower($ticketsubtype->priority);
                    $policy_priority    = $slapolicy->{$priority.'_resolution_time'};
                    $assignTime         = Carbon::parse($tickettimeline->assign_time);
                    $ticketAssignDay    = strtolower($assignTime->format('l'));
                    $pp_end_time        = $assignTime->addMinutes($policy_priority);
                    $currentDateTime    = Carbon::now();

                    if ($currentDateTime->greaterThan($pp_end_time) && $ticketAssignDay == $todayweekday) {
                        dd("assign");
                    }

                    if ($currentDateTime->greaterThan($pp_end_time) && $ticketAssignDay != $todayweekday) {

                        foreach ($days as $day_date => $day) {

                            $assign_date_time   = explode(" ", $tickettimeline->assign_time);
                            $assign_date        = $assign_date_time[0];

                            $assignTime         = Carbon::parse($tickettimeline->assign_time);
                            $ticketAssignDay    = strtolower($assignTime->format('l'));

                            if ($assign_date == $day_date) {
                                $oldworkingdayend   = $businessHours->{$ticketAssignDay . '_end'};
                                dd($oldworkingdayend);
                            }

                            dd($ticketAssignDay);
                        }



                        $nextDayIndex = (array_search($ticketAssignDay, $days) + 1) % 7;

                        while ($policy_priority > 0) {

                            $currentDay = $days[$nextDayIndex];
                            dd($currentDay);
                            $dayStart   = Carbon::parse($businessHours->{$currentDay . '_start'});
                            $dayEnd     = Carbon::parse($businessHours->{$currentDay . '_end'});

                            if ($businessHours->{$currentDay} == 'on') {
                                // Start counting from the start of this working day
                                $dayMinutes = $dayStart->diffInMinutes($dayEnd);
                                dd($dayMinutes);
                                if ($policy_priority <= $dayMinutes) {
                                    $endResolutionTime = $dayStart->addMinutes($policy_priority);
                                    send_notification($endResolutionTime);
                                    return;
                                } else {
                                    $policy_priority -= $dayMinutes;
                                }
                            }

                            // Move to the next working day
                            $nextDayIndex = ($nextDayIndex + 1) % 7;
                        }





                    }

                }


            }

        } else {// this will use for 24x7
           $tickettimelines = $latestTicketTimelines = TicketTimeline::select('*')
                    ->whereIn('id', function ($query) {
                        $query->select(DB::raw('MAX(id)'))
                            ->from('ticket_timelines')
                            ->groupBy('ticket_id');
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
            foreach ($tickettimelines as $key => $tickettimeline) {
                
                $ticket             = $tickettimeline->ticket;
                $ticketsetting      = TicketSetting::where('ticket_type_id', $ticket->tickettype_id)->first();
                $escalations_level  = $ticketsetting->escalations->where('level',$ticket->current_level)->first();
                $comment_check      = Comment::where([
                                            ['commenter', '=', $ticket->assigned_to],
                                            ['ticket_id', '=', $ticket->id],
                                      ])->get()->count();

                $assignDateTime     = new DateTime($tickettimeline->assign_time);
                $currentDateTime    = new DateTime();
                $interval           = $assignDateTime->diff($currentDateTime);

                if ($comment_check == 0 && $interval->days >= $escalations_level->days) {

                    $data = [];
                    $report_to = Employee::where('employee_id', $ticket->assignto->employee->report_to)->first();

                    if ($report_to) {
                        $assigned  = User::find($report_to->user_id);
                    }
                    
                    if( $report_to && $assigned){
                        $ticket->assigned_to   = $assigned->id;
                        $ticket->current_level = $ticket->current_level + 1;
                        $ticket->save();

                        $this->ticket_time_line([
                            'ticket_id'     => $ticket->id,
                            'assign_to'     => $assigned->id,
                            'assign_time'   => date('Y-m-d H:i:s'),
                            'assign_type'   => "By Auto Escalation",
                        ]);
                    }
                }
            }
        }

    }

    private function ticket_time_line($data)
    {
        TicketTimeline::create($data);
    }


}
