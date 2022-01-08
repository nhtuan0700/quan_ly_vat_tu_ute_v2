<?php

namespace App\Models;

use App\Traits\TimestampFormatTrait;
use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TimestampFormatTrait;

    protected $fillable = [
        'id', 'name', 'dob', 'tel', 'id_card', 
        'email', 'password', 'is_disabled',
        'id_department', 'id_role', 'id_position',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $incrementing = false;

    public function getDobAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format(app('date_format'));
        }
    }
    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::createFromFormat(app('date_format'), $value)->format('Y-m-d');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'id_department', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'id_position', 'id');
    }

    public function hasPermission(Permission $permission)
    {
        return !!optional(optional($this->role)->permissions)->contains($permission);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'id_user', 'id');
    }
}
