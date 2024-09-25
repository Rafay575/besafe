<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTimeline extends Model
{

    protected $fillable = [
        'ticket_id',
        'assign_to',
        'assign_time',
        'assign_type',

    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function assignto()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'ticket_id');
    }

}
