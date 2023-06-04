<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaLine extends Model
{
    use HasFactory;
    protected $fillable = ['line_title', 'group_name'];

}