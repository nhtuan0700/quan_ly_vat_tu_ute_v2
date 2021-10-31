<?php
namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\BaseRepository;
use App\Repositories\Role\RoleInterface;

class RoleRepository extends BaseRepository implements RoleInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Role::class;
    }
}