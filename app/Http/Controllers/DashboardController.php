<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ReportApiController;
use App\Http\Resources\HazardCollection;
use App\Http\Resources\IEAuditAnswersAttachementsCollection;
use App\Http\Resources\IEAuditAnswersCollection;
use App\Http\Resources\IncidentCollection;
use App\Models\FirePropertyDamage;
use App\Models\Hazard;
use App\Models\Injury;
use App\Models\InternalExternalAuditAnswer;
use App\Models\InternalExternalAuditClause;
use App\Models\NearMiss;
use App\Models\UnsafeBehavior;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        $userType = $user->user_type;
        $userId = $user->id;

        $incidentStats = [
            'open' => Ticket::where('status', 'Open')->where('assigned_to', $userId)->count(),

            'in_progress' => Ticket::where('status', 'in_progress')->where('assigned_to', $userId)->count(),
            'closed' => Ticket::where('status', 'Closed')->where('assigned_to', $userId)->count(),
            'feedback' => Ticket::where('status', 'feedback')->where('assigned_to', $userId)->count(),
        ];

        $total_tickets = Ticket::where("assigned_to", auth()->user()->id)->count();

        $tickets = Ticket::where('assigned_to', $userId)->paginate(perPage: 3);

        $priorityCounts = DB::table('tickets')
            ->join('ticket_sub_types', 'tickets.ticketsubtype_id', '=', 'ticket_sub_types.id')
            ->select('ticket_sub_types.priority', DB::raw('count(*) as total'))
            ->where('tickets.assigned_to', $userId)
            ->groupBy('ticket_sub_types.priority')
            ->get();

        // Prepare the data for view
        $priorityData = [
            'Urgent' => 0,
            'High' => 0,
            'Medium' => 0,
            'Low' => 0,
        ];

        foreach ($priorityCounts as $count) {
            $priorityData[$count->priority] = $count->total;
        }


        return view('dashboard.index', compact('incidentStats', 'userType', 'total_tickets', "tickets", 'priorityData'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}