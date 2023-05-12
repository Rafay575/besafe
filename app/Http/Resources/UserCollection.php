<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "ein" => $this->ein,
            "gender" => $this->gender,
            "dob" => $this->dob,
            "res_address" => $this->res_address,
            "perm_address" => $this->perm_address,
            "id_type" => $this->id_type,
            "id_no" => $this->id_no,
            "image" => asset('images/user/' . $this->image),
            "status" => $this->status,
            "meta_department_id" => $this->department ? $this->department->id : null,
            "department_title" => $this->department ? $this->department->department_title : null,
            "meta_unit_id" => $this->unit ? $this->unit->id : null,
            "unit_title" => $this->unit ? $this->unit->unit_title : null,
            "mea_line_id" => $this->line ? $this->line->id : null,
            "line_title" => $this->line ? $this->line->line_title : null,
            "meta_designation_id" => $this->designation ? $this->designation->id : null,
            "designation_title" => $this->designation ? $this->designation->designation_title : null,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}