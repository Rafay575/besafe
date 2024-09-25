<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\UserCollection;
use App\Models\TicketType;
use App\Models\Employee;
use App\Models\TicketSubType;
use App\Models\Region;
use App\Models\MetaLine;
use App\Models\MetaUnit;
use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketTimeline;
use App\Models\Comment;
use App\Models\TicketFeedback;
use Carbon\Carbon;
use Response;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $channel = "web")
    {
        $data = [];
        $data['tickets'] = Ticket::where('requested_by', auth()->user()->id)->get();
        return view('tickets.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['tickettypes'] = TicketType::get();
        $data['ticketsubtypes'] = TicketSubType::get();
        return view('tickets.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $channel = "web")
    {
        $input = $request->all();

        if ($request->hasFile('ticket_attachment')) {
            $fileName = time() . '.' . $request->ticket_attachment->getClientOriginalExtension();
            $request->ticket_attachment->move(public_path('ticket_attachment/files'), $fileName);
            $input['ticket_attachment'] = $fileName;
        }

        $ticket_type = TicketType::find($input['tickettype_id']);

        if ($ticket_type->name == 'HRPSP POC') {
            $user = User::where([
                ['region_id', '=', auth()->user()->region_id],
                ['poc_user', '=', 1],
            ])->first();

            $input['assigned_to'] = $user->id;
        } else {
            $employee = Employee::where('user_id', auth()->user()->id)->first();
            $report_to = Employee::where('employee_id', $employee->report_to)->first();
            $assigned = User::find($report_to->user_id);
            $input['assigned_to'] = $assigned->id;
        }

        $input['requested_by'] = auth()->user()->id;
        $input['status'] = "Open";
        $input['current_level'] = 1;
        $input['escalation_time_start'] = Carbon::now(); 
        $ticket = Ticket::create($input);

        $this->ticket_time_line([
            'ticket_id' => $ticket->id,
            'assign_to' => $input['assigned_to'],
            'assign_time' => date('Y-m-d H:i:s'),
            'assign_type' => "By Create",
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket Create Successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $data = [];
        $data['ticket'] = $ticket;
        $data['tickettypes'] = TicketType::get();
        $data['ticketsubtypes'] = TicketSubType::get();
        return view('tickets.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $input = $request->all();

        if ($request->hasFile('ticket_attachment')) {
            $fileName = time() . '.' . $request->ticket_attachment->getClientOriginalExtension();
            $request->ticket_attachment->move(public_path('ticket_attachment/files'), $fileName);
            $input['ticket_attachment'] = $fileName;
        }

        $ticket_type = TicketType::find($input['tickettype_id']);

        if ($ticket_type->name == 'HRPSP POC') {

            $user = User::where([
                ['region_id', '=', auth()->user()->region_id],
                ['poc_user', '=', 1],
            ])->first();

            $input['assigned_to'] = 4;
        } else {
            $employee = Employee::where('user_id', auth()->user()->id)->first();
            $report_to = Employee::where('employee_id', $employee->report_to)->first();
            $assigned = User::find($report_to->user_id);
            $input['assigned_to'] = $assigned->id;
        }

        $input['status'] = "Open";

        $ticket->fill($input);
        $ticket->save();

        $tickettimeline = TicketTimeline::where('ticket_id', $ticket->id)->latest()->first();

        if ($tickettimeline->assign_to != $ticket->assigned_to) {
            $this->ticket_time_line([
                'ticket_id' => $ticket->id,
                'assign_to' => $input['assigned_to'],
                'assign_time' => date('Y-m-d H:i:s'),
                'assign_type' => "By Update",
            ]);
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket has been deleted');
    }

    public function tickets_assign()
    {
        $data = [];
        $data['tickets'] = Ticket::where('assigned_to', auth()->user()->id)->get();
        return view('tickets.assign', $data);
    }

    public function tickets_reassign($id)
    {
        $data = [];
        $ticket = Ticket::find($id);
        $employee = Employee::where('user_id', $ticket->assigned_to)->first();
        $userIds = Employee::where('report_to', $employee->employee_id)->whereNotIn('user_id', [$ticket->requested_by])->pluck('user_id')->toArray();
        $data['users'] = User::whereIn('id', $userIds)->get();
        $data['ticket'] = $ticket;
        return view('tickets.reassign', $data);
    }

    public function tickets_assignto(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $ticket->assigned_to = $request->assign_to;
        $ticket->current_level = $ticket->current_level - 1;
        $ticket->save();

        $this->ticket_time_line([
            'ticket_id' => $ticket->id,
            'assign_to' => $request->assign_to,
            'assign_time' => date('Y-m-d H:i:s'),
            'assign_type' => "By Reassign",
        ]);

        return redirect()->route('tickets.assign')->with('success', 'Ticket Reassign Successfully!');
    }

    public function tickets_feedback($id)
    {
        $data = [];
        $data['ticket'] = Ticket::find($id);
        return view('tickets.feedback', $data);
    }

    public function feedback_add(Request $request)
    {
        $input = $request->all();
        TicketFeedback::create($input);
        return redirect()->route('tickets.index')->with('success', 'Feedback added Successfully!');
    }

    // Ticket.php (Ticket Model)



    public function tickets_view($id)
    {


        $ticket = Ticket::find($id);
        $ticket_feedback_exists = TicketFeedback::where('ticket_id', $ticket->id)->exists();
        $priority = $ticket && $ticket->ticketSubType ? $ticket->ticketSubType->priority : null;
        $assignedUserName = User::where("id", "=", $ticket->assigned_to)->first();
        $requested_byName = User::where("id", "=", $ticket->requested_by)->first();

        $departmentName = $requested_byName->department ? $requested_byName->department->name : 'No Department';
        $designationName = $requested_byName->designation ? $requested_byName->designation->name : 'No Designation';
        $regionName = $requested_byName->region ? $requested_byName->region->name : 'No Region';
        $subregionName = $requested_byName->subregion ? $requested_byName->subregion->name : 'No Subregion';
        $review_open = $ticket->feedback()->count() > 0 ? true : false;
        $data = [
            'ticket' => $ticket,
            'priority' => $priority,
            'assignedUserName' => $assignedUserName,
            'requested_byName' => $requested_byName,
            'departmentName' => $departmentName,
            'designationName' => $designationName,
            'regionName' => $regionName,
            'subregionName' => $subregionName,
            'ticket_feedback_exists' => $ticket_feedback_exists,

        ];

        return view('tickets.view', $data);
    }

    public function ticket_attachment_download($id)
    {
        $ticket = Ticket::find($id);
        return Response::download(public_path('ticket_attachment/files/' . $ticket->ticket_attachment));
    }

    public function comment_attachment_download($id)
    {
        $comment = Comment::find($id);
        return Response::download(public_path('comment_attachment/files/' . $comment->comment_attachment));
    }
    public function comment_attachment_view($id)
    {
        $comment = Comment::find($id);

        if ($comment && $comment->comment_attachment) {
            $path = public_path('comment_attachment/files/' . $comment->comment_attachment);

            if (file_exists($path)) {
                $mimeType = mime_content_type($path);
                if (in_array($mimeType, ['application/pdf', 'image/jpeg', 'image/png', 'image/gif'])) {
                    return response()->file($path);
                } else {
                    return redirect()->back()->with('error', 'This file type cannot be viewed in the browser.');
                }
            } else {
                return redirect()->back()->with('error', 'File not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Comment or attachment not found.');
        }
    }

    public function comment_add(Request $request)
    {
        $input = $request->all();

        if ($request->hasFile('comment_attachment')) {
            $fileName = time() . '.' . $request->comment_attachment->getClientOriginalExtension();
            $request->comment_attachment->move(public_path('comment_attachment/files'), $fileName);
            $input['comment_attachment'] = $fileName;
        }
        if ($request->has('voice_note')) {
            // Handle voice_note (Base64 data)
            $audioFileName = time() . '.wav'; // Adjust the extension based on the type you're using
            $audioData = base64_decode(preg_replace('/^data:audio\/\w+;base64,/', '', $request->voice_note));
            file_put_contents(public_path('comment_attachment/audios/') . $audioFileName, $audioData);
            $input['voice_note_path'] = $audioFileName;
        }
        Comment::create($input);

        return redirect()->back()->with('success', `Commnet Added Successfully `);
    }

    public function ticket_close(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return redirect()->back()->with('error', 'Ticket not found.');
        }
        // Update the ticket status to Closed
        $ticket->status = "Closed";

        $input = $request->all();
        // Handle file attachment
        if ($request->hasFile('comment_attachment')) {
            $fileName = time() . '.' . $request->comment_attachment->getClientOriginalExtension();
            $request->comment_attachment->move(public_path('comment_attachment/files'), $fileName);
            $input['comment_attachment'] = $fileName;
        }
        // Save the comment
        Comment::create($input);

        $ticket->save();

        return redirect()->route('tickets.index')->with('success', 'Ticket closed and comment added successfully.');
    }

    private function ticket_time_line($data)
    {
        TicketTimeline::create($data);
    }

    public function profileCreate()
    {
        return view('users.profile');
    }

    public function profileStore(Request $request)
    {
        return $this->update($request, auth()->user()->id, 'web');
    }

    public function countAllTickets()
    {
        $totalTickets = Ticket::count();
        return response()->json([
            'total_tickets' => $totalTickets,
        ]);
    }

}