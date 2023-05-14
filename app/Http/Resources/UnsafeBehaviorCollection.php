<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnsafeBehaviorCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public $withAttachs = false;
    public $withAssignUser = false;

    public function toArray(Request $request): array
    {
        if ($request->has('with')) {
            $params = explode(',', $request->with);
            if (in_array('attachements', $params)) {
                $this->withAttachs = true;
            }
            if (in_array('assigned_users', $params)) {
                $this->withAssignUser = true;
            }
        }

        $data = [
            'id' => $this->id,
            "meta_department_id" => $this->meta_department_id ?? null,
            "department_title" => $this->department ? $this->department->department_title : null,
            "meta_unit_id" => $this->meta_unit_id ?? null,
            "unit_title" => $this->unit ? $this->unit->unit_title : null,
            "meta_line_id" => $this->meta_line_id ?? null,
            "line_title" => $this->line ? $this->line->line_title : null,
            'meta_incident_status_id' => $this->meta_incident_status_id ?? null,
            'incident_status_title' => $this->incident_status ? $this->incident_status->status_title : null,
            'initiated_by' => $this->initiated_by,
            'date' => $this->date,
            'details' => $this->details,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'unsafe_behavior_types' => MetaUnsafeBehaviorTypesCollection::collection($this->unsafe_behavior_types),
        ];
        if ($this->withAttachs) {
            $data['attachements'] = CommonAttachsCollection::collection($this->attachements);
        }
        if ($this->withAssignUser) {
            $data['assigned_users'] = IncidentAssignCollection::collection($this->assignedUsers);
        }
        return $data;
    }
}