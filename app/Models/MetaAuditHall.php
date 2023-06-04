<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaAuditHall extends Model
{
    use HasFactory;
    protected $fillable = ['hall_title', 'group_name'];

}