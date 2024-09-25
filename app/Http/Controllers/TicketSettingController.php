<?php

namespace App\Http\Controllers;

use App\Models\TicketSetting;
use App\Models\TicketEscalation;
use App\Models\TicketSubType;
use App\Models\TicketType;
use App\Models\User;
use App\Http\Requests\StoreTicketSubTypeRequest;
use App\Http\Requests\UpdateTicketSubTypeRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class TicketSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [];
        $data['ticketsettings'] = TicketSetting::with('ticket_type', 'ticket_sub_type')->get();
        // dd($data);
        return view('ticketsetting.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['tickettypes']    = TicketType::get();
        $data['ticketsubtypes'] = TicketSubType::get();
        return view('ticketsetting.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $ticket_setting = TicketSetting::create($input);
        foreach ($input['escalation'] as $key => $escalation) {
            $escalation['ticket_setting_id'] = $ticket_setting->id;
            $escalation['level']             = $key;
            TicketEscalation::create($escalation);
        }
        return redirect()->route('ticketsetting.index')->with('success', 'Create successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(UpdateTicketSubTypeRequest $request, TicketSubType $ticketsubtype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketSetting $ticketsetting)
    {
        $data = [];
        $data['ticketsetting']  = $ticketsetting;
        $data['tickettypes']    = TicketType::get();
        $data['ticketsubtypes'] = TicketSubType::get();
        return view('ticketsetting.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketSetting $ticketsetting)
    {
        $input = $request->all();
        $ticketsetting->fill($input);
        $ticketsetting->save();
        $ticketsetting->escalations()->delete();

        foreach ($input['escalation'] as $key => $escalation) {
            $escalation['ticket_setting_id'] = $ticketsetting->id;
            $escalation['level']             = $key;
            TicketEscalation::create($escalation);
        }
        return redirect()->route('ticketsetting.index')->with('success', 'Create successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketSetting $ticketsetting)
    {
        $ticketsetting->escalations()->delete();
        if ($ticketsetting->delete()) {
            return redirect()->route('ticketsetting.index')->with('success', 'Delete successfully!');
        } else {
            return redirect()->route('ticketsetting.index')->with('error', 'Something went wrong!');
        }
    }
}
