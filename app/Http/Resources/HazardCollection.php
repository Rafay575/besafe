<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HazardCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public $withAttachs = false;

    public function toArray(Request $request): array
    {
        if ($request->has('with')) {
            $params = explode(',', $request->with);
            if (in_array('attachements', $params)) {
                $this->withAttachs = true;
            }
        }
        return [
            'id' => $this->id,
            'meta_unit_id' => $this->meta_unit_id,
            'meta_department_id' => $this->meta_department_id,
            'meta_risk_level' => $this->meta_risk_level_id,
            'meta_department_tag_id' => $this->meta_department_tag_id,
            'meta_line_id' => $this->meta_line_id,
            'meta_incident_status_id' => $this->meta_incident_status_id,
            'initiated_by' => $this->initiated_by,
            'location' => $this->location,
            'description' => $this->description,
            'date' => $this->date,
            'action_cost' => $this->action_cost,


        ];

    }
}