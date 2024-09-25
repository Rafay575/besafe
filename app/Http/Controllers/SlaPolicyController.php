<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\BusinessHours;
use App\Models\SlaPolicy;
use DateTimeZone;
use DateTime;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class SlaPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,)
    {
        $data = [];
        $data['slapolicy'] = SlaPolicy::first();
        return view('slapolicy.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['priorities'] = Priority::get();
        return view('slapolicy.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        SlaPolicy::create($input);
        return redirect()->route('slapolicies.index')->with('success', 'Create successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(UpdateDepartmentRequest $request, Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [];
        $data['slapolicy']  = SlaPolicy::find($id);
        $data['priorities'] = Priority::get();
        return view('slapolicy.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input      = $request->all();
        $slapolicy  = SlaPolicy::find($id);
        $slapolicy->fill($input);
        $slapolicy->save();
        return redirect()->route('slapolicies.index')->with('success', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SlaPolicy $slapolicy)
    {
        if ($slapolicy->delete()) {
            return redirect()->route('slapolicies.index')->with('success', 'Delete successfully!');
        } else {
            return redirect()->route('slapolicies.index')->with('error', 'Something went wrong!');
        }
    }

}
