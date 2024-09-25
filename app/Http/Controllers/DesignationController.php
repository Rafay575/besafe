<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,)
    {
        if ($request->ajax()) {
            $data = [];
            $i = 0;
            $designations = Designation::get();
            foreach ($designations as $designation) {
                $i++;

                $data[] = [
                    'sno' => $i,
                    'name' => $designation->name,
                    'action' => view('designations.partials.action-buttons', ['designations' => $designation])->render()
                ];
            }
            return DataTables::of($data)->toJson();
        }
        return view('designations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        return view('designations.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDesignationRequest $request)
    {
        $input = $request->all();
        Designation::create($input);
        return redirect()->route('designations.index')->with('success', 'Create successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(UpdateDesignationRequest $request, Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        $data = [];
        $data['designation'] = $designation;
        return view('designations.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        $input = $request->all();
        $designation->fill($input);
        $designation->save();
        return redirect()->route('designations.index')->with('success', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation, $channel = "web")
    {
        if ($designation->delete()) {
            if ($channel === 'api') {
                return ApiResponseController::success('Designation has been delete');
            } else {
                return ['deleted', 'Designation has been deleted'];
            }
        } else {
            if ($channel === 'api') {
                return ApiResponseController::error('Could not delete the Designation.');
            } else {
                return ['error', 'Could not delete the Designation'];
            }
        }
    }
}
