<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaLocation extends Model
{
    use HasFactory;
    protected $fillable = ['location_title', 'meta_unit_id'];

    public function unit()
    {
        return $this->belongsTo(MetaUnit::class, 'meta_unit_id');
    }
}