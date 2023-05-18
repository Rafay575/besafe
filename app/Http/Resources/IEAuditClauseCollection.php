<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IEAuditClauseCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public $withQuestions = false;
    public $withAnswers = false;

    public function toArray(Request $request): array
    {
        if ($request->has('with')) {
            $params = explode(',', $request->with);
            if (in_array('questions', $params)) {
                $this->withQuestions = true;
            }
            if (in_array('answers', $params)) {
                $this->withAnswers = true;
            }
        }
        $data = [
            'id' => $this->id,
            "meta_audit_type_id" => $this->meta_audit_type_id ?? null,
            "audit_type_title" => $this->audit_type ? $this->audit_type->audit_title : null,
            "meta_audit_hall_id" => $this->meta_audit_hall_id ?? null,
            "audit_hall_title" => $this->audit_hall ? $this->audit_hall->hall_title : null,
            'audit_date' => $this->audit_date,
            'initiated_by' => $this->initiated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        // if ($this->withQuestions) {
        if ($this->audit_type && $this->audit_type->audit_questions) {
            $data['questions'] = IEAuditQuestionsCollection::collection($this->audit_type->audit_questions);
        }
        $data['questions'] = null;
        // }
        // if ($this->withAnswers) {
        if ($this->audit_answers) {
            $data['answers'] = IEAuditAnswersCollection::collection($this->audit_type->answers);
        }
        $data['answers'] = null;
        // }

        return $data;

    }
}