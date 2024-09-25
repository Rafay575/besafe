<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'name',
        'p_region_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Region::class, 'p_region_id');
    }
    
}
