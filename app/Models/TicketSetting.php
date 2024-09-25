<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSetting extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'ticket_type_id',
        'ticket_sub_type_id',
    ];

    public function ticket_type()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }

    public function ticket_sub_type()
    {
        return $this->belongsTo(TicketSubType::class, 'ticket_sub_type_id');
    }

    public function escalations()
    {
        return $this->hasMany(TicketEscalation::class, 'ticket_setting_id');
    }
}
