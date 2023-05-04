<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitToWork extends Model
{
    use HasFactory;
    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }

    public function ptw_type()
    {
        return $this->belongsTo(MetaPtwType::class);
    }

    public function ptw_item()
    {
        return $this->belongsTo(MetaPtwItem::class);
    }


}