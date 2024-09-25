<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'ticket_id',
        'commenter',
        'description',
        'comment_attachment',
        'voice_note_path'
    ];


    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function commenter_user()
    {
        return $this->belongsTo(User::class, 'commenter');
    }

}
