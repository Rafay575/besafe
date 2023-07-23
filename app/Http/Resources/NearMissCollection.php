<?php

namespace App\Http\Resources;

use App\Http\Resources\CommonAttachsCollection;
use App\Http\Resources\IncidentAssignCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NearMissCollection extends JsonResource
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
            "id" => $this->id,
            'date' => $this->date,
            'time' => $this->time,
            'initiated_by' => $this->initiated_by,
            // 'location' => $this->location,
            'description' => $this->description,
            'immediate_action' => $this->immediate_action,
            'immediate_cause' => $this->immediate_cause,
            'root_cause' => $this->root_cause,
            'actions' => $this->actions,
            "meta_unit_id" => $this->meta_unit_id ?? null,
            "unit_title" => $this->unit ? $this->unit->unit_title : null,
            "other_location" => $this->other_location,
            "shift" => $this->shift,
            "meta_near_miss_class_id" => $this->meta_near_miss_class_id ?? null,
            "near_miss_class_title" => $this->near_miss_class ? $this->near_miss_class->class_title : null,
            "meta_location_id" => $this->meta_location_id ?? null,
            "location_title" => $this->meta_location ? $this->meta_location->location_title : null,
            "meta_department_id" => $this->meta_department_id ?? null,
            "department_title" => $this->department ? $this->department->department_title : null,
            'meta_incident_status_id' => $this->meta_incident_status_id,
            'incident_status_title' => $this->incident_status ? $this->incident_status->status_title : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'initial_recommendation' => $this->initial_recommendation,
            'witness_name' => $this->witness_name,
            'person_involved' => $this->person_involved,
            'persons' => $this->persons,
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