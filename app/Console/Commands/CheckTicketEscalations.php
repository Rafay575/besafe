<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;
use App\Models\Ticket;
use App\Models\BusinessHours;
use Carbon\Carbon;
class CheckTicketEscalations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:check-escalations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and escalate tickets based on business hours and escalation rules';
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        \Log::info('The tickets:check-escalations command ran successfully.');
        if (!$this->isWorkingTime()) {
            // Log and skip the process
            $this->info('Not in working hours or on a non-working day. Skipping ticket escalation.');
            return;
        }

        // Fetch unresolved tickets
        $tickets = Ticket::where('status', 'open')->get();

        foreach ($tickets as $ticket) {

            if ($ticket->shouldEscalate()) {
                $this->info('Should esscalated ');
                $this->escalateTicket($ticket);
            } else {

                $this->info('Should not esscalated ');
            }
        }
    }
    protected function isWorkingTime()
    {
        $now = Carbon::now();

        $businessHours = BusinessHours::find(1);
        $workingDays = $businessHours->getWorkingDays();
        $currentDay = strtolower(now()->format('l'));
        $currentTime = $now->format('H:i');
        $dayTimes = $businessHours->getStartEndTimesForDay($currentDay);

        if (!in_array($currentDay, $workingDays)) {
            return false;
        }

        // Check if today is a holiday
        // if (in_array($now->toDateString(), $holidays)) {
        //     return false;
        // }

        if (!($currentTime >= $dayTimes['start'] && $currentTime <= $dayTimes['end'])) {
            return false;
        }

        return true;
    }
    protected function escalateTicket($ticket)
    {
        $nextLevel = $ticket->current_level + 1;
        $nextAssignee = $this->getNextAssignee($ticket->assigned_to, $nextLevel);

        if ($nextAssignee) {
            $ticket->current_level = $nextLevel;
            $ticket->assigned_to = $nextAssignee->id;
            $ticket->escalation_time_start = Carbon::now();
            $ticket->save();

            // // Notify the new assignee
            // Notification::send($nextAssignee, new TicketEscalatedNotification($ticket));
        }
    }

    protected function getNextAssignee($_id, $escalationLevel)
    {
        // Fetch the next responsible person/department based on escalation level
        $next_assign = Employee::where('id', $_id)->first()->report_to;
        return Employee::where('employee_id', $next_assign)->first();
    }



}

