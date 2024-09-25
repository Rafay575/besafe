<?php

namespace App\Http\Controllers;

use App\Models\TicketSubType;
use App\Models\Priority;
use App\Http\Requests\StoreTicketSubTypeRequest;
use App\Http\Requests\UpdateTicketSubTypeRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class TicketSubTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [];
        $data['ticketsubtypes'] = TicketSubType::get();
        return view('ticketsubtypes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['priorities'] = Priority::get();
        return view('ticketsubtypes.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketSubTypeRequest $request)
    {
        $input = $request->all();
        TicketSubType::create($input);
        return redirect()->route('ticketsubtypes.index')->with('success', 'Create successfully!');
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
    public function edit(TicketSubType $ticketsubtype)
    {
        $data = [];
        $data['ticketsubtype'] = $ticketsubtype;
        $data['priorities'] = Priority::get();
        return view('ticketsubtypes.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketSubTypeRequest $request, TicketSubType $ticketsubtype)
    {
        $input = $request->all();
        $ticketsubtype->fill($input);
        $ticketsubtype->save();
        return redirect()->route('ticketsubtypes.index')->with('success', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketSubType $ticketsubtype)
    {
        if ($ticketsubtype->delete()) {
            return redirect()->route('ticketsubtypes.index')->with('success', 'Delete successfully!');
        } else {
            return redirect()->route('ticketsubtypes.index')->with('error', 'Something went wrong!');
        }
    }
}
