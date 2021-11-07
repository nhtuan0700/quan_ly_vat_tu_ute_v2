<?php

namespace App\Repositories\HanMuc;

use App\Models\HanMuc;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class HanMucRepository extends BaseRepository implements HanMucInterface
{
    public function getModel()
    {
        return HanMuc::class;
    }

    public function findItem($id_user, $id_vanphongpham)
    {
        return $this->model
            ->where('id_user', $id_user)
            ->where('id_vanphongpham', $id_vanphongpham)
            ->select('*')
            ->selectRaw('qty_max - qty_used as qty_remain');
    }

    public function listHanMucByUser($id_user)
    {
        return DB::table('vanphongpham')
            ->join('hanmuc', 'hanmuc.id_vanphongpham', '=', 'vanphongpham.id')
            ->where('hanmuc.id_user', $id_user)
            ->whereNull('vanphongpham.deleted_at')
            ->orderBy('name', 'asc')
            ->select('id', 'name', 'dvt', 'qty_used', 'qty_max')
            ->get();
    }
}
