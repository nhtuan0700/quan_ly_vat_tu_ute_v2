<?php

namespace App\Repositories\DetailFix;

use App\Models\DetailFix;
use App\Repositories\BaseRepository;

class DetailFixRepository extends BaseRepository implements DetailFixInterface
{
    public function getModel()
    {
        return DetailFix::class;
    }

    public function updateWhenConfirmed($id)
    {
        // foreach ($vanphongpham as $id_vanphongpham => $item) {
        //     $this->model->where('id_phieu', $id_phieu)->where('id_vanphongpham', $id_vanphongpham)
        //         ->update(['cost'=> $item['cost']]);
        // }
    }
}
