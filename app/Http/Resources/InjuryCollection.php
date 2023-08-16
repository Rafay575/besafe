<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InjuryCollection extends JsonResource
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
            "meta_injury_category_id" => $this->meta_injury_category_id ?? null,
            "injury_category_title" => $this->injury_category->injury_category_title ?? null,
            "meta_incident_category_id" => $this->meta_incident_category_id,
            "incident_category_title" => $this->incident_category->incident_category_title ?? null,
            "meta_department_id" => $this->meta_department_id ?? null,
            "department_title" => $this->department ? $this->department->department_title : null,
            "meta_unit_id" => $this->meta_unit_id ?? null,
            "unit_title" => $this->unit ? $this->unit->unit_title : null,
            "meta_location_id" => $this->meta_location_id ?? null,
            "location_title" => $this->meta_location ? $this->meta_location->location_title : null,
            "other_location" => $this->other_location,
            "employee_involved" => $this->employee_involved,
            "reference" => $this->reference,
            "line" => $this->line,
            "witness_name" => $this->witness_name,
            "injured_person" => $this->injured_person,
            // "sgfl_relation" => $this->sgfl_relation,
            // "meta_sgfl_relation_id" => $this->meta_sgfl_relation_id,
            // "sgfl_relation_title" => $this->msgfl_relation->sgfl_relation_title ?? null,
            "details" => $this->details,
            "immediate_action" => $this->immediate_action,
            "key_finding" => $this->key_finding,
            'incident_status_title' => $this->incident_status ? $this->incident_status->status_title : null,
            'initiated_by' => $this->initiated_by,
            'date' => $this->date,
            'time' => $this->time,
            'root_cause' => $this->root_cause,
            "meta_immediate_causes" => InjuryCausesCollection::collection($this->immediate_causes),
            // "meta_root_causes" => InjuryCausesCollection::collection($this->root_causes),
            // "meta_basic_causes" => InjuryCausesCollection::collection($this->basic_causes),
            "meta_contact_types" => InjuryContactsCollection::collection($this->contacts),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'actions' => $this->actions,
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