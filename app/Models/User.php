<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function unsafe_behaviors()
    {
        return $this->hasMany(UnsafeBehavior::class, 'initiated_by');
    }

    public function hazards()
    {
        return $this->hasMany(Hazard::class, 'initiated_by');
    }

    public function near_misses()
    {
        return $this->hasMany(NearMiss::class, 'initiated_by');
    }

    public function fire_property_demages()
    {
        return $this->hasMany(FirePropertyDamage::class, 'initiated_by');
    }

    public function injuries()
    {
        return $this->hasMany(Injury::class, 'initiated_by');
    }

    public function common_attachemts()
    {
        return $this->hasMany(CommonAttachement::class);
    }

    public function ptw()
    {
        return $this->hasMany(PermitToWork::class, 'initiated_by');
    }

    public function ie_audit_ans_attachs()
    {
        return $this->hasMany(InternalExternalAuditAnswerAttachement::class);
    }

    public function unit()
    {
        return $this->belongsTo(MetaUnit::class, 'meta_unit_id');
    }

    public function department()
    {
        return $this->belongsTo(MetaDepartment::class, 'meta_department_id');
    }

    public function designation()
    {
        return $this->belongsTo(MetaDesignation::class, 'meta_designation_id');
    }

    public function line()
    {
        return $this->belongsTo(MetaLine::class, 'meta_line_id');
    }

    public function audit_attachs()
    {
        return $this->hasMany(InternalExternalAuditAnswerAttachement::class);
    }

}