<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaIncidentStatus extends Model
{
    use HasFactory;
    protected $fillable = ['status_title', 'group_name', 'status_code'];

}