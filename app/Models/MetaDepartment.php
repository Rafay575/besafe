<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaDepartment extends Model
{
    protected $fillable = ['department_title', 'group_name'];
    use HasFactory;
}