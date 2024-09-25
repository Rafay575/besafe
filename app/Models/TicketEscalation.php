<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketEscalation extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'ticket_setting_id',
        'level',
        'days',
    ];
}
