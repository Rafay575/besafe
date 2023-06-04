<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaBasicCause extends Model
{
    protected $fillable = ['cause_title', 'group_name'];

    use HasFactory;
}