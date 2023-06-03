<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\IEAuditAnswersCollection;
use App\Models\InternalExternalAuditAnswer;
use App\Models\InternalExternalAuditAnswerAttachement;
use App\Models\InternalExternalAuditClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InternalExternalAuditAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $channel = "web")
    {
        RolesPermissionController::can(['ie_audit_cluase.index']);

        $validator = Validator::make($request->all(), [
            'ie_audit_clause_id' => ['required', 'exists:ie_audit_clauses,id'],
        ]);

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $audit_answers = InternalExternalAuditAnswer::where('ie_audit_clause_id', $request->ie_audit_clause_id)->get();

        if ($channel == "api") {
            return IEAuditAnswersCollection::collection($audit_answers);
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
    public function store(Request $request, $channel = "web")
    {
        RolesPermissionController::can(['ie_audit_cluase.create']);


        $validator = Validator::make($request->all(), [
            'ie_audit_clause_id' => ['required', 'exists:ie_audit_clauses,id'],
            'meta_ie_audit_question_id' => ['required', 'exists:meta_ie_audit_questions,id'],
            'yes_or_no' => ['required', 'boolean'],
            'response' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
            'attachements' => ['array', 'nullable'],
            'attachements.*' => ['mimes:jpeg,png,jpg,gif|max:2048'],
        ]);

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        // additional validations
        $auditClause = InternalExternalAuditClause::where('id', $request->ie_audit_clause_id)->first();
        if ($auditClause) {
            // if answer is submitted once then it should not be submmited again. it should be updated
            $answredQuestion = $auditClause->audit_answers->where('meta_ie_audit_question_id', $request->meta_ie_audit_question_id)->count();
            if ($answredQuestion != 0) {
                return ApiResponseController::error('Audit Question is already answered. Please use update answer api');
            }
            // checking if audit question exist in current audit type
            $auditQuestions = $auditClause->audit_type->audit_questions;
            $existQuestion = $auditQuestions->where('id', $request->meta_ie_audit_question_id)->count();
            if ($existQuestion != 1) {
                return ApiResponseController::error('Audit Question not found for this audit clause');
            }
        }




        $ieAuditAnswer = new InternalExternalAuditAnswer();
        $ieAuditAnswer->ie_audit_clause_id = $request->ie_audit_clause_id;
        $ieAuditAnswer->meta_ie_audit_question_id = $request->meta_ie_audit_question_id;
        $ieAuditAnswer->yes_or_no = $request->yes_or_no;
        // $ieAuditAnswer->response = $request->response;
        // $ieAuditAnswer->remarks = $request->remarks;

        $ieAuditAnswer->save();

        if ($request->has('attachements')) {
            $this::uploadAuditAttachements($request->attachements, $ieAuditAnswer);
        }

        // score calcuation 
        InternalExternalAuditClauseController::auditScoreCalculator($auditClause->id);

        return ApiResponseController::successWithData('Audit Answer has been submitted.', new IEAuditAnswersCollection($ieAuditAnswer));

    }

    /**
     * Display the specified resource.
     */
    public function show(InternalExternalAuditAnswer $internalExternalAuditAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InternalExternalAuditAnswer $internalExternalAuditAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $answer_id, $channel = "web")
    {
        RolesPermissionController::can(['ie_audit_cluase.edit']);

        $validator = Validator::make($request->all(), [
            'yes_or_no' => ['required', 'boolean'],
            'attachements' => ['array', 'nullable'],
            'attachements.*' => ['mimes:jpeg,png,jpg,gif|max:2048'],
        ]);

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $ieAuditAnswer = InternalExternalAuditAnswer::where('id', $answer_id)->first();

        if (!$ieAuditAnswer) {
            return ApiResponseController::error('Audit answer not found', 404);
        }
        $ieAuditAnswer->yes_or_no = $request->yes_or_no;
        // $ieAuditAnswer->response = $request->response;
        // $ieAuditAnswer->remarks = $request->remarks;

        $ieAuditAnswer->save();
        // score calcuation 
        InternalExternalAuditClauseController::auditScoreCalculator($ieAuditAnswer->ie_audit_clause_id);

        if ($request->has('attachements')) {
            $this::uploadAuditAttachements($request->attachements, $ieAuditAnswer);
        }
        return ApiResponseController::successWithData('Audit Answer has been updated.', new IEAuditAnswersCollection($ieAuditAnswer));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternalExternalAuditAnswer $internalExternalAuditAnswer)
    {
        //
    }

    public static function uploadAuditAttachements($filesArray, $ieAuditAnswer)
    {
        foreach ($filesArray as $file) {
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path("attachements/ie_audit/"), $file_name);
            $attachement = new InternalExternalAuditAnswerAttachement();
            $attachement->file_name = $file_name;
            $attachement->ie_audit_answer_id = $ieAuditAnswer->id;
            $attachement->user_id = auth()->user()->id;
            $attachement->save();
        }
    }

    public function validateData($request)
    {
        return Validator::make($request->all(), [
            'ie_audit_clause_id' => ['required', 'exists:ie_audit_clauses,id'],
            'meta_ie_audit_question_id' => ['required', 'exists:meta_ie_audit_questions,id'],
            'yes_or_no' => ['required', 'boolean'],
            'response' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
            'attachements' => ['array', 'nullable'],
            'attachements.*' => ['mimes:jpeg,png,jpg,gif|max:2048'],
        ]);
    }
}