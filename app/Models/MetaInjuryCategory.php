<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaInjuryCategory extends Model
{
    use HasFactory;
    protected $fillable = ['injury_category_title', 'group_name'];

}