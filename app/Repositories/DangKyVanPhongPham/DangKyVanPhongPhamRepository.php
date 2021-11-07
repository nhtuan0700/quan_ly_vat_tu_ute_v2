<?php
namespace App\Repositories\DangKyVanPhongPham;

use Carbon\Carbon;
use App\Models\DangKyVanPhongPham;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;

class DangKyVanPhongPhamRepository extends BaseRepository implements DangKyVanPhongPhamInterface
{
    public function getModel()
    {
        return DangKyVanPhongPham::class;
    }

    public function listDangKy($id_user, $id_dotdk)
    {
        return DB::table('vanphongpham')
            ->join('dangky_vanphongpham', 'dangky_vanphongpham.id_vanphongpham', '=', 'vanphongpham.id')
            ->join('hanmuc', 'hanmuc.id_vanphongpham', '=', 'vanphongpham.id')
            ->where('hanmuc.id_user', $id_user)
            ->where('dangky_vanphongpham.id_dotdk', $id_dotdk)
            ->whereNull('vanphongpham.deleted_at')
            ->orderBy('name', 'asc')
            ->select('id', 'name', 'dvt', 'qty')
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
}