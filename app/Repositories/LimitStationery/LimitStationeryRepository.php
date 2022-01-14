<?php

namespace App\Repositories\LimitStationery;

use App\Models\LimitStationery;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class LimitStationeryRepository extends BaseRepository implements LimitStationeryInterface
{
    public function getModel()
    {
        return LimitStationery::class;
    }

    public function findItem($id_user, $id_stationery)
    {
        return $this->model
            ->where('id_user', $id_user)
            ->where('id_stationery', $id_stationery)
            ->select('*')
            ->selectRaw('qty_max - qty_used as qty_remain');
    }

    public function listByUser($id_user)
    {
        return DB::table('stationery')
            ->leftjoin('limit_stationery', function ($join) use ($id_user) {
                $join->on('limit_stationery.id_stationery', '=', 'stationery.id')
                ->where('limit_stationery.id_user', $id_user);
            })
            ->whereNull('stationery.deleted_at')
            ->select('id', 'name', 'unit', 'qty_used', 'qty_max', 'qty_update')
            ->orderby('qty_update', 'desc')
            ->orderby('qty_max', 'desc')
            ->orderby('id', 'asc')
            ->get();
    }
}
