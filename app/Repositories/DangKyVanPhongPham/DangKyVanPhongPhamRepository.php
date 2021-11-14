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
            ->select('id', 'name', 'dvt', 'qty', 'id_phieu', 'received_at')
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

    public function detailByDonVi($id_dotdk, $id_donvi, $id_phieu = null)
    {
        return DB::table('dangky_vanphongpham')
            ->join('users', 'users.id', '=', 'dangky_vanphongpham.id_user')
            ->join('donvi', 'donvi.id', '=', 'users.id_donvi')
            ->join('vanphongpham', 'vanphongpham.id', '=', 'dangky_vanphongpham.id_vanphongpham')
            ->where('dangky_vanphongpham.id_dotdk', $id_dotdk)
            ->when(is_null($id_phieu), function ($query) use ($id_donvi) {
                return $query->where('users.id_donvi', $id_donvi)
                    ->whereNull('dangky_vanphongpham.id_phieu');
            }, function ($query) use ($id_phieu) {
                return $query->where('dangky_vanphongpham.id_phieu', $id_phieu);
            })
            ->whereNull('vanphongpham.deleted_at')
            ->orderBy('users.id', 'asc')
            ->select(
                'users.id as id_user',
                'vanphongpham.id as id_vpp',
                'users.name as name_user',
                'vanphongpham.name as name_vpp',
                'dvt',
                'qty',
                'received_at',
                'donvi.name as name_donvi'
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
            ->whereNull('dangky_vanphongpham.id_phieu')
            ->whereNull('vanphongpham.deleted_at')
            ->select('id_vanphongpham', 'vanphongpham.name', 'dvt')
            ->selectRaw('sum(qty) as qty')
            ->groupBy('id_vanphongpham', 'vanphongpham.name', 'dvt')
            ->get();
    }

    public function updateAfterCreated($id_donvi, $id_dotdk, $id_phieu)
    {
        return $this->model
            ->whereIn('id_user', function ($query) use ($id_donvi) {
                $query->select('id')->from('users')->where('id_donvi', $id_donvi);
            })
            ->whereNull('id_phieu')
            ->where('id_dotdk', $id_dotdk)
            ->update(['id_phieu' => $id_phieu]);
    }
}
