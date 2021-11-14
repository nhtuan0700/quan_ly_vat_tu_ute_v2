<?php

namespace App\Repositories\DangKyVanPhongPham;

use App\Repositories\RepositoryInterface;

interface DangKyVanPhongPhamInterface extends RepositoryInterface
{
    public function listByUser($id_user, $id_dotdk);
    public function detailByDonVi($id_dotdk, $id_donvi);
    public function tongHopDangKyDonVi($id_dotdk, $id_donvi);
    public function findItem($id_user, $id_vanphongpham, $id_dotdk);
    public function updateAfterCreated($id_donvi, $id_dotdk, $id_phieu);
}
