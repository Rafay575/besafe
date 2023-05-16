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
            "employee_involved" => $this->employee_involved,
            "witness_name" => $this->witness_name,
            "sgfl_relation" => $this->sgfl_relation,
            "details" => $this->details,
            "immediate_action" => $this->immediate_action,
            "key_finding" => $this->key_finding,
            'incident_status_title' => $this->incident_status ? $this->incident_status->status_title : null,
            'initiated_by' => $this->initiated_by,
            'date' => $this->date,
            "meta_immediate_causes" => InjuryCausesCollection::collection($this->immediate_causes),
            "meta_root_causes" => InjuryCausesCollection::collection($this->root_causes),
            "meta_basic_causes" => InjuryCausesCollection::collection($this->basic_causes),
            "meta_contact_types" => InjuryContactsCollection::collection($this->contacts),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        if ($this->withAttachs) {
            $data['attachements'] = CommonAttachsCollection::collection($this->attachements);
            $data['interview_attachs'] = CommonAttachsCollection::collection($this->interview_attachs);
        }
        if ($this->withAssignUser) {
            $data['assigned_users'] = IncidentAssignCollection::collection($this->assignedUsers);
        }

        return $data;

    }
}