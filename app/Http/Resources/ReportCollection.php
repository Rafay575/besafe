<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportCollection extends JsonResource
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
            'report_of' => $this->report_of,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            "file" => asset('reports/' . $this->file_name),
            'generated_by' => $this->user->first_name,
            'created_at' => $this->created_at,
        ];
    }
}