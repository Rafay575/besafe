<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaContactType extends Model
{
    protected $fillable = ['type_title', 'group_name'];

    use HasFactory;
}