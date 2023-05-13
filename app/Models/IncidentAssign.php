<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentAssign extends Model
{
    use HasFactory;

    public function assignBy()
    {
        return $this->belongsTo(User::class, 'assign_by');
    }
    public function assignTo()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }
}