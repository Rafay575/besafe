<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaRiskLevel extends Model
{
    use HasFactory;
    protected $fillable = ['risk_level_title', 'group_name', 'days_required'];

}