<?php

namespace App\Repositories\DetailBuy;

use App\Models\DetailBuy;
use App\Repositories\BaseRepository;

class DetailBuyRepository extends BaseRepository implements DetailBuyInterface
{
    public function getModel()
    {
        return DetailBuy::class;
    }

    public function updateWhenConfirmed($id_phieu, $vanphongpham)
    {
        foreach ($vanphongpham as $id_vanphongpham => $item) {
            $this->model->where('id_phieu', $id_phieu)->where('id_vanphongpham', $id_vanphongpham)
                ->update(['cost'=> $item['cost']]);
        }
    }
}
