<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDeparmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,)
    {
        $data = [];
        $data['departments'] = Department::get();
        return view('departments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        return view('departments.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeparmentRequest $request)
    {
        $input = $request->all();
        Department::create($input);
        return redirect()->route('departments.index')->with('success', 'Create successfully!');
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
    public function edit(Department $department)
    {
        $data = [];
        $data['department'] = $department;
        return view('departments.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $input = $request->all();
        $department->fill($input);
        $department->save();
        return redirect()->route('departments.index')->with('success', 'Update successfully!');
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
}
