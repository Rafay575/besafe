<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncidentCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'incident_id' => $this->id,
            'incident_name' => $this->incident_name,
            'initiated_by' => $this->initiated_by,
            'initiated_by_email' => $this->initiator->email,
            'initiated_by_name' => $this->initiator->first_name . " " . $this->initiator->last_name,
            'meta_incident_status_id' => $this->meta_incident_status_id ?? null,
            'incident_status_title' => $this->incident_status ? $this->incident_status->status_title : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}