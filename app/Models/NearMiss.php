<?php

namespace App\Models;

use App\Traits\CommonRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearMiss extends Model
{
    use HasFactory;
    use CommonRelation;
    protected $casts = [
        'actions' => 'json'
    ];


    public function attachements()
    {
        return $this->hasMany(CommonAttachement::class, 'incident_id')->where('form_name', $this->getTable());
    }
}