<?php

namespace App\Http\Controllers;

use App\Models\InternalExternalAuditAnswer;
use App\Models\InternalExternalAuditClause;
use App\Models\MetaInternalExternalAuditQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IEAuditBulkResponseController extends Controller
{
    public function edit($ieAuditClauseId)
    {
        $ieAuditClause = InternalExternalAuditClause::where('id', $ieAuditClauseId)->firstOrFail();
        $auditQuestions = $ieAuditClause->audit_type->audit_questions;
        // return $auditQuestions->find(27)->audit_answer->find(83)->attachements;
        return view('ie_audits.audit_init', compact('auditQuestions', 'ieAuditClause'));
    }

    public function show($ieAuditClauseId)
    {
        $ieAuditClause = InternalExternalAuditClause::where('id', $ieAuditClauseId)->firstOrFail();
        $auditQuestions = $ieAuditClause->audit_type->audit_questions;
        // return $auditQuestions->find(27)->audit_answer->find(83)->attachements;
        return view('ie_audits.audit_init_show', compact('auditQuestions', 'ieAuditClause'));
    }

    public function store(Request $request)
    {
        RolesPermissionController::can(['ie_audit_cluase.create']);
        $ie_audit = InternalExternalAuditClause::find($request->ie_audit_clause_id)->firstOrFail();
        foreach ($request->response as $key => $response) {
            $question_id = $key;
            if (array_key_exists('yes_or_no', $response)) {
                $yes_or_no = $response['yes_or_no'];
                $reqResponse = $response['response'] ?? '';
                $remarks = $response['remarks'] ?? '';
                $ieAuditAnswer = InternalExternalAuditAnswer::where('ie_audit_clause_id', $request->ie_audit_clause_id)->where('meta_ie_audit_question_id', $question_id)->first();
                if (!$ieAuditAnswer) {
                    $ieAuditAnswer = new InternalExternalAuditAnswer();
                    $ieAuditAnswer->ie_audit_clause_id = $request->ie_audit_clause_id;
                    $ieAuditAnswer->meta_ie_audit_question_id = $question_id;
                }
                $ieAuditAnswer->yes_or_no = $yes_or_no;
                $ieAuditAnswer->response = $reqResponse;
                $ieAuditAnswer->remarks = $remarks;
                $ieAuditAnswer->save();
                if (array_key_exists('attachements', $response)) {
                    InternalExternalAuditAnswerController::uploadAuditAttachements($response['attachements'], $ieAuditAnswer);
                }
            }

        }

        // score calcuation 
        InternalExternalAuditClauseController::auditScoreCalculator($request->ie_audit_clause_id);

        return ['success', 'Audit Responses updated!', $request->redirect];
    }
}