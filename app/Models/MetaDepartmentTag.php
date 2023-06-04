<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaDepartmentTag extends Model
{
    protected $fillable = ['department_tag_title', 'group_name'];

    use HasFactory;
}