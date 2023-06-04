<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaSgflRelation extends Model
{
    use HasFactory;
    protected $fillable = ['sgfl_relation_title', 'group_name'];

}