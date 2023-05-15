<?php

namespace App\Http\Resources\Api;

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
            'location' => $this->location,
            'description' => $this->description,
            'immediate_action' => $this->immediate_action,
            'immediate_cause' => $this->immediate_cause,
            'root_cause' => $this->root_cause,
            'actions' => $this->actions,
            'meta_incident_status_id' => $this->meta_incident_status_id,
            'incident_status_title' => $this->incident_status ? $this->incident_status->status_title : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
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