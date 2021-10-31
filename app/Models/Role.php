<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN = 1;
    const CSVC = 2;
    const QLVT = 3;
    const GVCB = 4;

    protected $table = 'role';

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'id_role', 'id_permission');
    }
}
