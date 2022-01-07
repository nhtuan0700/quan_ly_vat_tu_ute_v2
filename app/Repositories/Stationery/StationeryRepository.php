<?php

namespace App\Repositories\Stationery;

use App\Models\Stationery;
use App\Repositories\BaseRepository;
use App\Repositories\Department\DepartmentInterface;
use App\Repositories\LimitDefault\LimitDefaultInterface;
use App\Repositories\LimitStationery\LimitStationeryInterface;
use App\Repositories\User\UserInterface;

class StationeryRepository extends BaseRepository implements StationeryInterface
{
    public function getModel()
    {
        return Stationery::class;
    }

    public function create($attributes = [])
    {
        $new_stationery = parent::create($attributes);
        // Insert table limit_registration
        // Cập nhật hạn mức của người dùng
        $userRepo = app(UserInterface::class);
        $limitRepo = app(LimitStationeryInterface::class);
        $users = $userRepo->all();
        foreach ($users as $item) {
            $limit = [
                'id_user' => $item->id,
                'id_stationery' => $new_stationery->id,
                'qty_used' => 0,
                'qty_max' => 0,
                'quarter_year' => quarter_of_year(),
                'year' => now()->year
            ];
            $limitRepo->create($limit);
        }
        // Insert table limit_default
        // Cập nhật hạn mức theo chức vụ
        $limitDefaultRepo = app(LimitDefaultInterface::class);
        $departmentRepo = app(DepartmentInterface::class);
        $departments = $departmentRepo->all();
        foreach ($departments as $deparment) {
            $positions = $deparment->positions();
            foreach ($positions as $position) {
                $limitDefaultRepo->create([
                    'id_department' => $deparment->id,
                    'id_position' => $position->id,
                    'id_stationery' => $new_stationery->id,
                    'qty' => 0
                ]);
            }
        }
        return $new_stationery;
    }
}
