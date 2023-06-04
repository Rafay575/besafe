<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaPtwType extends Model
{
    use HasFactory;
    protected $fillable = ['ptw_type_title', 'group_name'];

}