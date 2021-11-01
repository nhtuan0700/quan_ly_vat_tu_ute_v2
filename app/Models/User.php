<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'dob', 'tel', 'cmnd', 'id_donvi', 'id_role',
        'email', 'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getDobAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y');
    }
    public function setDobAttribute($value) {
        $this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }

    public function donVi()
    {
        return $this->belongsTo(DonVi::class, 'id_donvi', 'id');
    }

    public function hasPermission(Permission $permission)
    {
        return !!optional(optional($this->role)->permissions)->contains($permission);
    }
}
