<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaIncidentCategory extends Model
{
    use HasFactory;
    protected $fillable = ['incident_category_title', 'group_name'];

}