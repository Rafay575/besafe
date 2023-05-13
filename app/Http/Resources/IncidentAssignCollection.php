<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncidentAssignCollection extends JsonResource
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
            'assign_by' => $this->assign_by,
            'assign_to' => $this->assign_to,
            'assign_by_user' => [
                'id' => $this->assignBy->id,
                'first_name' => $this->assignBy->first_name,
                'last_name' => $this->assignBy->last_name,
                'email' => $this->assignBy->email,
            ],
            'assign_to_user' => [
                'id' => $this->assignTo->id,
                'first_name' => $this->assignTo->first_name,
                'last_name' => $this->assignTo->last_name,
                'email' => $this->assignTo->email,
            ],
        ];
    }
}