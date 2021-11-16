<?php
namespace App\Repositories\Stationery;

use App\Models\Stationery;
use App\Repositories\BaseRepository;
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
        $userRepo = app(UserInterface::class);
        $limitRepo = app(LimitStationeryInterface::class);
        $users = $userRepo->all();
        foreach ($users as $item) {
            $limit = [
                'id_user' => $item->id,
                'id_stationery' => $new_stationery->id,
                'qty_used' => 0,
                'qty_max' => $new_stationery->limit_avg,
                'quarter_year' => quarter_of_year(),
                'year' => now()->year
            ];
            $limitRepo->create($limit);
        }
        return $new_stationery;
    }
}