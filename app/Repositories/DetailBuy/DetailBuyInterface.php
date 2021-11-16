<?php

namespace App\Repositories\DetailBuy;

use App\Repositories\RepositoryInterface;

interface DetailBuyInterface extends RepositoryInterface
{
    public function updateWhenConfirmed($id_phieu, $vanphongpham);
}
