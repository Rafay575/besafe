<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaPtwType extends Model
{
    use HasFactory;
    protected $fillable = ['ptw_type_title', 'group_name'];

    public function ptws()
    {
        return $this->belongsToMany(PermitToWork::class, 'meta_ptw_type_permit_to_work');
    }

}