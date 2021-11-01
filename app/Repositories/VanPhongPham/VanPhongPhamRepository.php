<?php
namespace App\Repositories\VanPhongPham;

use App\Models\VanPhongPham;
use App\Repositories\BaseRepository;

class VanPhongPhamRepository extends BaseRepository implements VanPhongPhamInterface
{
    public function getModel()
    {
        return VanPhongPham::class;
    }
}