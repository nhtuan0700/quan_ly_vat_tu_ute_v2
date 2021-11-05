<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Role\RoleInterface;
use App\Repositories\User\UserInterface;

class UserRepository extends BaseRepository implements UserInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return User::class;
    }

    public function getAutoId()
    {
        $prefix = '505';
        $last_field = $this->model->where('id', 'like', "$prefix%")
            ->orderby('created_at', 'desc')
            ->orderby('id', 'desc')->first();
        if (!$last_field) {
            $count = str_pad(1, 4, '0', STR_PAD_LEFT);
        } else {
            $count = intval(substr($last_field->id, -4)) + 1;
            $count = str_pad($count, 4, '0', STR_PAD_LEFT);
        }
        $new_id = $prefix . $count;
        return $new_id;
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

    public function create($attributes = [])
    {
        $attributes['id'] = $attributes['id'] ?? $this->getAutoId();
        return parent::create($attributes);
    }
}
