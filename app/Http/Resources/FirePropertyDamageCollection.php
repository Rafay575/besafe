<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FirePropertyDamageCollection extends JsonResource
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
            "meta_location_id" => $this->meta_location_id ?? null,
            "location_title" => $this->meta_location ? $this->meta_location->location_title : null,
            'meta_incident_status_id' => $this->meta_incident_status_id ?? null,
            'incident_status_title' => $this->incident_status ? $this->incident_status->status_title : null,
            'initiated_by' => $this->initiated_by,
            'other_location' => $this->other_location,
            'line' => $this->line,
            'description' => $this->description,
            'date' => $this->date,
            'reference' => $this->reference,
            'meta_fire_category_id' => $this->meta_fire_category_id,
            'fire_category_title' => $this->fire_category->fire_category_title ?? null,
            'meta_property_damage_id' => $this->meta_property_damage_id,
            'property_damage_title' => $this->property_damage->property_damage_title ?? null,
            'immediate_action' => $this->immediate_action,
            'immediate_cause' => $this->immediate_cause,
            'root_cause' => $this->root_cause,
            'similar_incident_before' => $this->similar_incident_before,
            'loss_calculation' => $this->loss_calculation,
            'loss_recovery_method' => $this->loss_recovery_method,
            'preventative_measure' => $this->preventative_measure,
            'actions' => $this->actions,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        if ($this->withAttachs) {
            $data['attachements'] = CommonAttachsCollection::collection($this->attachements);
            $data['initial_attachements'] = CommonAttachsCollection::collection($this->initial_attachements);
            // $data['initial_attachs'] = CommonAttachsCollection::collection($this->initial_attachs);
            // $data['interview_attachs'] = CommonAttachsCollection::collection($this->interview_attachs);
            // $data['record_attachs'] = CommonAttachsCollection::collection($this->record_attachs);
            // $data['photograph_attachs'] = CommonAttachsCollection::collection($this->photograph_attachs);
            // $data['other_attachs'] = CommonAttachsCollection::collection($this->other_attachs);
        }
        if ($this->withAssignUser) {
            $data['assigned_users'] = IncidentAssignCollection::collection($this->assignedUsers);
        }

        return $data;

    }
}