<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlaPolicy extends Model
{
    use HasFactory;

    protected $fillable = [ 
      "name",
      "description",
      "urgent_first_response_time",
      "urgent_resolution_time",
      "urgent_operational_hours",
      "urgent_escalation",
      "high_first_response_time",
      "high_resolution_time",
      "high_operational_hours",
      "high_escalation",
      "medium_first_response_time",
      "medium_resolution_time",
      "medium_operational_hours",
      "medium_escalation",
      "low_first_response_time",
      "low_resolution_time",
      "low_operational_hours",
      "low_escalation",
    ];
}
