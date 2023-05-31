<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermitToWorkCollection extends JsonResource
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
            'date' => $this->date,
            'initiated_by' => $this->initiated_by,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'work_area' => $this->work_area,
            'line_machine' => $this->line_machine,
            'is_ptw_exist' => $this->is_ptw_exist,
            'cross_reference' => $this->cross_reference,
            'moc_required' => $this->moc_required,
            'moc_title' => $this->moc_title,
            'moc_desc' => $this->moc_desc,
            "meta_ptw_type_id" => $this->meta_ptw_type_id,
            "ptw_type_title" => $this->ptw_type->ptw_type_title ?? null,
            'working_group' => $this->working_group,
            'worker_name' => $this->worker_name,
            'immediate_cause' => $this->immediate_cause,
            'root_cause' => $this->root_cause,
            'actions' => $this->actions,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'ptw_items' => MetaPtwItemCollection::collection($this->ptw_items),
        ];

    }
}