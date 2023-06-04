<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaImmediateCause extends Model
{
    use HasFactory;
    protected $fillable = ['cause_title', 'group_name'];

}