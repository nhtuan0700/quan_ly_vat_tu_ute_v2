<?php

namespace App\Repositories\ChiTietMua;

use App\Repositories\RepositoryInterface;

interface ChiTietMuaInterface extends RepositoryInterface
{
    public function updateWhenConfirmed($id_phieu, $vanphongpham);
}
