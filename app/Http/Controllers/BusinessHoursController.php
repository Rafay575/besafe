<?php

namespace App\Http\Controllers;

use App\Models\BusinessHours;
use DateTimeZone;
use DateTime;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class BusinessHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,)
    {
        $data = [];
        $data['businesshours'] = BusinessHours::first();
        return view('businesshours.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['timezones'] = $this->gettimezonelist();
        return view('businesshours.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        BusinessHours::create($input);
        return redirect()->route('businesshours.index')->with('success', 'Create successfully!');
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
    public function edit(BusinessHours $businesshours, $id)
    {
        $data = [];
        $data['businesshours']  = BusinessHours::find($id);
        $data['timezones']      = $this->gettimezonelist();
        return view('businesshours.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $businesshours = BusinessHours::find($id);
        $businesshours->fill($input);
        $businesshours->save();
        return redirect()->route('businesshours.index')->with('success', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        if ($department->delete()) {
            return redirect()->route('departments.index')->with('success', 'Delete successfully!');
        } else {
            return redirect()->route('departments.index')->with('error', 'Something went wrong!');
        }
    }

    private function gettimezonelist()
    {
        $timezones      = DateTimeZone::listIdentifiers();
        $timezoneList   = [];

        foreach ($timezones as $timezone) {
            $dateTimeZone   = new DateTimeZone($timezone);
            $dateTime       = new DateTime("now", $dateTimeZone);
            $offset         = $dateTimeZone->getOffset($dateTime);
            $hours          = (int) ($offset / 3600);
            $minutes        = abs($offset % 3600 / 60);
            $gmtOffset      = 'GMT' . ($hours >= 0 ? '+' : '-') . str_pad(abs($hours), 2, '0', STR_PAD_LEFT) . ':' . str_pad($minutes, 2, '0', STR_PAD_LEFT);
            $timezoneList[] = $timezone . ' (' . $gmtOffset . ')';
        }

        return $timezoneList;
    }
}
