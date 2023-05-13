<?php

namespace App\Http\Controllers;

use App\Models\IncidentAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IncidentAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $incident, $channel, $assignCount = 4)
    {
        $validator = $this->validateData($request);

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $incidentAssignedCollection = IncidentAssign::where('incident_id', $incident->id)->get();
        $allowedAssign = 1;

        // one user cannot be both assigner or assing to
        if ($request->assign_to === $request->assign_by) {
            return ['error', 'Cannot assign to yourself'];
        }

        if (!$incidentAssignedCollection->count() == 0) {


            // A can assign to B only once B can assign to C
            if ($incidentAssignedCollection->last()->assign_to != $request->assign_by or $incidentAssignedCollection->where('assign_by', $request->assign_by)->count() > 1) {
                return ['error', 'You are not allowed to assign'];
            }

            // if A assign to B then B cannot assign back to A
            if ($incidentAssignedCollection->where('assign_by', $request->assign_to)->count() > 0) {
                return ['error', 'cannot assign to predecessor'];
            }
            // should not allow to assign more than allowed assignement hierarchy limit
            if ($incidentAssignedCollection->last()->assign_count >= $assignCount) {
                return ['error', 'Cannot assign further as limit breaced'];
            }

            if ($incidentAssignedCollection->last()->assign_count === $assignCount) {
                $allowedAssign = 0;
            }
        }
        $incidentAssigned = new IncidentAssign();
        // if everything goes will then we shoul dbe able to prcess the data
        $incidentAssigned->assign_count += $incidentAssigned->assign_count;
        $incidentAssigned->incident_id = $incident->id;
        $incidentAssigned->form_name = $incident->getTable();
        $incidentAssigned->assign_by = $request->assign_by;
        $incidentAssigned->assign_to = $request->assign_to;
        $incidentAssigned->allowed_assign = $allowedAssign;
        $incidentAssigned->assign_count = $incidentAssignedCollection->last() ? $incidentAssignedCollection->last()->assign_count + 1 : 1;
        $incidentAssigned->save();

        return ['success', $incident];
    }


    /**
     * Display the specified resource.
     */
    public function show(IncidentAssign $incidentAssign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncidentAssign $incidentAssign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncidentAssign $incidentAssign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncidentAssign $incidentAssign)
    {
        //
    }

    public function validateData(Request $request)
    {
        return
            Validator::make($request->all(), [
                'assign_by' => 'required|exists:users,id',
                'assign_to' => 'required|exists:users,id',
            ]);
    }
}