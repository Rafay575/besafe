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

    public static function getRouteName()
    {
        return 'ptws.show'; //show route name
    }
    public function ptw_types()
    {
        return $this->belongsToMany(MetaPtwType::class, 'meta_ptw_type_permit_to_work');
    }

    public function ptw_items()
    {
        return $this->belongsToMany(MetaPtwItem::class, 'meta_ptw_item_permit_to_work');
    }


}