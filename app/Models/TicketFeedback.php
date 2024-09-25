<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketFeedback extends Model
{
    protected $fillable = [
        'ticket_id',
        'reviewer',
        'review',
        'rate',
    ];


    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function reviewer_user()
    {
        return $this->belongsTo(User::class, 'reviewer');
    }

}
