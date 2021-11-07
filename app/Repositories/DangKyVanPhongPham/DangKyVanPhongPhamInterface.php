<?php

namespace App\Repositories\DangKyVanPhongPham;

use App\Repositories\RepositoryInterface;

interface DangKyVanPhongPhamInterface extends RepositoryInterface
{
    public function listDangKy($id_user, $id_dotdk);
    public function findItem($id_user, $id_vanphongpham, $id_dotdk);
}
