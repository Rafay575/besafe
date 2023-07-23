<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaUnit extends Model
{
    use HasFactory;
    protected $fillable = ['unit_title', 'group_name'];

    public function locations()
    {
        return $this->hasMany(MetaLocation::class, 'meta_unit_id');
    }
}