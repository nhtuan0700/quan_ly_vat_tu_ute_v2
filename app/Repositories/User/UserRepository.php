<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\LimitDefault\LimitDefaultInterface;
use App\Repositories\LimitStationery\LimitStationeryInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Stationery\StationeryInterface;

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

    public function create($attributes = [])
    {
        $attributes['id'] = $attributes['id'] ?? $this->getAutoId();
        $new_user = parent::create($attributes);
        // Cập nhật hạn mức văn phòng phẩm bằng cách lấy hạn mức từ hạn mức mặc định từ chức vụ của user đó
        $limitRepo = app(LimitStationeryInterface::class);
        $limitDefaultRepo = app(LimitDefaultInterface::class);
        $limit_defaults = $limitDefaultRepo
            ->where('id_department', $new_user->id_department)
            ->where('id_position', $new_user->id_position)
            ->get();

        foreach ($limit_defaults as $item) {
            $limit = [
                'id_user' => $new_user->id,
                'id_stationery' => $item->id_stationery,
                'qty_used' => 0,
                'qty_max' => $item->qty,
                'quarter_year' => quarter_of_year(),
                'year' => now()->year
            ];
            $limitRepo->create($limit);
        }
        return $new_user;
    }
}
