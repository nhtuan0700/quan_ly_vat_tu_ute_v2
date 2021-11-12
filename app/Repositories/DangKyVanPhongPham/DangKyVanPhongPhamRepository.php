<?php

namespace App\Repositories\DangKyVanPhongPham;

use App\Models\DangKyVanPhongPham;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;

class DangKyVanPhongPhamRepository extends BaseRepository implements DangKyVanPhongPhamInterface
{
    public function getModel()
    {
        return DangKyVanPhongPham::class;
    }

    public function listByUser($id_user, $id_dotdk)
    {
        return DB::table('dangky_vanphongpham')
            ->join('vanphongpham', 'vanphongpham.id', '=', 'dangky_vanphongpham.id_vanphongpham')
            ->join('hanmuc', 'hanmuc.id_vanphongpham', '=', 'vanphongpham.id')
            ->where('dangky_vanphongpham.id_user', $id_user)
            ->where('hanmuc.id_user', $id_user)
            ->where('dangky_vanphongpham.id_dotdk', $id_dotdk)
            ->whereNull('vanphongpham.deleted_at')
            ->orderBy('name', 'asc')
            ->select('id', 'name', 'dvt', 'qty', 'is_tonghop', 'received_at')
            ->selectRaw('qty_max - qty_used as qty_remain')
            ->get();
    }

    public function findItem($id_user, $id_vanphongpham, $id_dotdk)
    {
        return $this->model
            ->where('id_user', $id_user)
            ->where('id_vanphongpham', $id_vanphongpham)
            ->where('id_dotdk', $id_dotdk)
            ->select('*')
            ->selectRaw('qty_max - qty_used as qty_remain');
    }

    public function listByDonVi($id_dotdk, $id_donvi)
    {
        return DB::table('dangky_vanphongpham')
            ->join('users', 'users.id', '=', 'dangky_vanphongpham.id_user')
            ->join('vanphongpham', 'vanphongpham.id', '=', 'dangky_vanphongpham.id_vanphongpham')
            ->where('users.id_donvi', $id_donvi)
            ->where('dangky_vanphongpham.id_dotdk', $id_dotdk)
            ->whereNull('vanphongpham.deleted_at')
            ->select(
                'users.id as id_user',
                'vanphongpham.id as id_vpp',
                'users.name as name_user',
                'vanphongpham.name as name_vpp',
                'dvt',
                'qty',
                'received_at'
            )
            ->get();
    }

    public function tongHopDangKyDonVi($id_dotdk, $id_donvi)
    {
        return DB::table('dangky_vanphongpham')
            ->join('users', 'users.id', '=', 'dangky_vanphongpham.id_user')
            ->join('vanphongpham', 'vanphongpham.id', '=', 'dangky_vanphongpham.id_vanphongpham')
            ->where('users.id_donvi', $id_donvi)
            ->where('dangky_vanphongpham.id_dotdk', $id_dotdk)
            ->where('dangky_vanphongpham.is_tonghop', false)
            ->whereNull('vanphongpham.deleted_at')
            ->select('id_vanphongpham', 'vanphongpham.name', 'dvt')
            ->selectRaw('sum(qty) as qty')
            ->groupBy('id_vanphongpham', 'vanphongpham.name', 'dvt')
            ->get();
    }

    public function updateStatusDonVi($id_donvi)
    {
        return $this->model
            ->whereIn('id_user', function($query) use ($id_donvi) {
                $query->select('id')->from('users')->where('id_donvi', $id_donvi);
            })
            ->update(['is_tonghop' => true]);
    }
}
