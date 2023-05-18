<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IEAuditAnswersCollection extends ResourceCollection
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
            'question' => $this->audit_question->question,
            'answer' => $this->yes_or_no ? 'yes' : 'no',
            'attachements' => IEAuditAnswersAttachementsCollection::collection($this->attachements),
        ];
    }
}