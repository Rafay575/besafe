<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IEAuditAnswersCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question_id' => $this->meta_ie_audit_question_id,
            'question' => $this->audit_question ? $this->audit_question->question : null,
            'answer' => $this->yes_or_no ? 'yes' : 'no',
            'attachements' => $this->attachements ? IEAuditAnswersAttachementsCollection::collection($this->attachements) : null,
        ];
    }
}