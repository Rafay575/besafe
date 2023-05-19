<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\InternalExternalAuditAnswerController;
use App\Http\Controllers\InternalExternalAuditClauseController;
use App\Http\Controllers\InternalExternalAuditQuestionController;
use App\Http\Resources\IEAuditAnswersCollection;
use App\Http\Resources\IEAuditClauseCollection;
use App\Http\Resources\IEAuditQuestionsCollection;
use Illuminate\Http\Request;

class IEAuditClauseApiController extends Controller
{
    public function index(Request $request)
    {
        $limit = 20;
        $id_audit = (new InternalExternalAuditClauseController)->index('api');
        if ($request->has('limit')) {
            $limit = $request->limit;
        }
        if ($request->has('from_date') and $request->has('to_date')) {
            $id_audit = $id_audit->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        if ($request->has('meta_audit_type_id')) {
            $id_audit = $id_audit->where('meta_audit_type_id', $request->meta_audit_type_id);
        }
        if ($request->has('meta_audit_hall_id')) {
            $id_audit = $id_audit->where('meta_audit_hall_id', $request->meta_audit_hall_id);
        }

        if ($request->has('initiated_by')) {
            $id_audit = $id_audit->where('initiated_by', $request->initiated_by);
        }

        if ($id_audit) {
            return IEAuditClauseCollection::collection($id_audit->paginate($limit));
            // return ApiResponseController::successWithJustData(IEAuditClauseCollection::collection($id_audit->paginate($limit)));
        } else {
            return ApiResponseController::error('Problme while fetching Audits');
        }
    }

    public function getAnswers(Request $request)
    {
        $response = (new InternalExternalAuditAnswerController)->index($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while fetching Audit Answers.', 400);
        }
    }

    public function getQuestions(Request $request)
    {
        $response = (new InternalExternalAuditQuestionController)->index($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while fetching Audit Answers.', 400);
        }
    }



    public function store(Request $request)
    {
        $response = (new InternalExternalAuditClauseController)->store($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while storing Audit.', 400);
        }

    }

    public function submitAnswer(Request $request)
    {
        $response = (new InternalExternalAuditAnswerController)->store($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while storing Audit Answer.', 400);
        }

    }
    public function updateAnswer(Request $request, $answer_id)
    {
        $response = (new InternalExternalAuditAnswerController)->update($request, $answer_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while storing Audit Answer.', 400);
        }

    }
    public function update(Request $request, $ie_audit_id)
    {
        $response = (new InternalExternalAuditClauseController)->update($request, $ie_audit_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while updating Audit.', 400);
        }
    }
    public function show(Request $request, $ie_audit_id)
    {
        $ptw = (new InternalExternalAuditClauseController)->show($ie_audit_id, 'api');
        if ($ptw) {
            return ApiResponseController::successWithJustData(new IEAuditClauseCollection($ptw));
        } else {
            return ApiResponseController::error('Problem while fetching Audits.', 400);
        }
    }



    public function destroy($ie_audit_id)
    {
        $response = (new InternalExternalAuditClauseController)->destroy($ie_audit_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while deleting Audit.', 400);
        }
    }
}