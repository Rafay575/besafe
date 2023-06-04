<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaFireCategory extends Model
{
    use HasFactory;
    protected $fillable = ['fire_category_title', 'group_name'];

}