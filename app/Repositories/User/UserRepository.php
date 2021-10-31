<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Role\RoleInterface;
use App\Repositories\User\UserInterface;

class UserRepository extends BaseRepository implements UserInterface
{
    public $roleRepository;

    public function __construct(RoleInterface $roleRepository)
    {
        parent::__construct();
        $this->roleRepository = $roleRepository;
    }
    //lấy model tương ứng
    public function getModel()
    {
        return User::class;
    }

    public function listExceptAdmin($columns = NULL, $limit = NULL)
    {
        $limit =  $limit ?? $this->limit;
        $users = $this->model->query();
        if (!$columns) {
            return $users->orderBy('id', 'desc')->paginate($limit);
        }
        $strict = ['id', 'id_role', 'status'];
        return $this->search($columns, $strict, $limit, $users);
    }
}
