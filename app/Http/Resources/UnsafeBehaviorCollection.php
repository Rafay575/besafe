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
            "meta_unsafe_behavior_action_id" => $this->meta_unsafe_behavior_action_id ?? null,
            "unsafe_behavior_action_title" => $this->unsafe_behavior_action ? $this->unsafe_behavior_action->action_title : null,
            "meta_unit_id" => $this->meta_unit_id ?? null,
            "unit_title" => $this->unit ? $this->unit->unit_title : null,
            "meta_location_id" => $this->meta_location_id ?? null,
            "location_title" => $this->meta_location ? $this->meta_location->location_title : null,
            'meta_risk_level_id' => $this->meta_risk_level_id ?? null,
            'risk_level_title' => $this->risk_level ? $this->risk_level->risk_level_title : null,
            "line" => $this->line,
            "other_location" => $this->other_location,
            // "meta_line_id" => $this->meta_line_id ?? null,
            // "line_title" => $this->line ? $this->line->line_title : null,
            'meta_incident_status_id' => $this->meta_incident_status_id ?? null,
            'incident_status_title' => $this->incident_status ? $this->incident_status->status_title : null,
            'initiated_by' => $this->initiated_by,
            'date' => $this->date,
            'details' => $this->details,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'action' => $this->action,
            'unsafe_behavior_types' => MetaUnsafeBehaviorTypesCollection::collection($this->unsafe_behavior_types),
        ];
        if ($this->withAttachs) {
            $data['attachements'] = CommonAttachsCollection::collection($this->attachements);
            $data['initial_attachements'] = CommonAttachsCollection::collection($this->initial_attachements);
        }
        if ($this->withAssignUser) {
            $data['assigned_users'] = IncidentAssignCollection::collection($this->assignedUsers);
        }
        return $data;
    }
}