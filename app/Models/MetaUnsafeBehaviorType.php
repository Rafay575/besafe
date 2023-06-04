<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaUnsafeBehaviorType extends Model
{
    use HasFactory;
    protected $fillable = ['unsafe_behavior_type_title', 'group_name'];

}