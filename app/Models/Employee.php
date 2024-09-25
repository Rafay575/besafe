<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'department_id',
        'designation_id',
        'mobile',
        'grade',
        'employee_id',
        'region_id',
        'sub_region_id',
        'report_to',
        'email',
        'user_type',
        'secondary_email',
        'image',
        'password',
    ];
    public static function getRouteName()
    {
        return 'employees.show'; //show route name
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
