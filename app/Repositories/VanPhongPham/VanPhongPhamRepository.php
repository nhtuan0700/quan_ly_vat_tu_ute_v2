<?php
namespace App\Repositories\VanPhongPham;

use App\Models\VanPhongPham;
use App\Repositories\BaseRepository;
use App\Repositories\HanMuc\HanMucRepository;
use App\Repositories\User\UserRepository;

class VanPhongPhamRepository extends BaseRepository implements VanPhongPhamInterface
{
    public function getModel()
    {
        return VanPhongPham::class;
    }

    public function create($attributes = [])
    {
        $new_data = parent::create($attributes);
        $userRepository = new UserRepository;
        $hanMucRepository = new HanMucRepository;
        $users = $userRepository->all();
        foreach ($users as $item) {
            $hanMuc = [
                'id_user' => $item->id,
                'id_vanphongpham' => $new_data->id,
                'qty_used' => 0,
                'qty_max' => $new_data->hanmuc_tb,
                'quy' => quy_in_year(),
                'year' => now()->year
            ];
            $hanMucRepository->create($hanMuc);
        }
        return $new_data;
    }
}