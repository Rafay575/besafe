<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use App\Http\Requests\StoreTicketTypeRequest;
use App\Http\Requests\UpdateTicketTypeRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,)
    {
        $data = [];
        $data['tickettypes'] = TicketType::get();
        return view('tickettypes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        return view('tickettypes.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketTypeRequest $request)
    {
        $input = $request->all();
        TicketType::create($input);
        return redirect()->route('tickettypes.index')->with('success', 'Create successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(UpdateTicketTypeRequest $request, TicketType $tickettype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketType $tickettype)
    {
        $data = [];
        $data['tickettype'] = $tickettype;
        return view('tickettypes.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketTypeRequest $request, TicketType $tickettype)
    {
        $input = $request->all();
        $tickettype->fill($input);
        $tickettype->save();
        return redirect()->route('tickettypes.index')->with('success', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketType $tickettype)
    {
        if ($tickettype->delete()) {
            return redirect()->route('tickettypes.index')->with('success', 'Delete successfully!');
        } else {
            return redirect()->route('tickettypes.index')->with('error', 'Something went wrong!');
        }
    }
}
