<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN = 1;
    const HANDLER = 2;
    const MANAGER = 3;
    const GUEST = 4;
    const HANDLER_LIMIT = 5;

    protected $table = 'role';

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'id_role', 'id_permission');
    }
}
