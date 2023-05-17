<?php

namespace App\Models;

use App\Traits\CommonRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitToWork extends Model
{
    use HasFactory;
    use CommonRelation;
    protected $casts = [
        'actions' => 'json'
    ];
    public function ptw_type()
    {
        return $this->belongsTo(MetaPtwType::class, 'meta_ptw_type_id');
    }

    public function ptw_item()
    {
        return $this->belongsTo(MetaPtwItem::class, 'meta_ptw_item_id');
    }


}