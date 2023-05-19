<?php

namespace App\Http\Controllers;

use App\Http\Resources\IEAuditQuestionsCollection;
use App\Models\MetaInternalExternalAuditQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InternalExternalAuditQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $channel = "web")
    {
        RolesPermissionController::can(['ie_audit_cluase.index']);

        $validator = Validator::make($request->all(), [

            'meta_audit_type_id' => ['required', 'exists:meta_audit_types,id'],
        ]);

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }
        $audit_questions = MetaInternalExternalAuditQuestion::where('meta_audit_type_id', $request->meta_audit_type_id)->get();

        if ($channel == "api") {
            return IEAuditQuestionsCollection::collection($audit_questions);
        }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InternalExternalAuditQuestion $internalExternalAuditQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InternalExternalAuditQuestion $internalExternalAuditQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InternalExternalAuditQuestion $internalExternalAuditQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternalExternalAuditQuestion $internalExternalAuditQuestion)
    {
        //
    }
}