<?php

namespace App\Repositories\ChiTietSua;

use App\Models\ChiTietSua;
use App\Repositories\BaseRepository;

class ChiTietSuaRepository extends BaseRepository implements ChiTietSuaInterface
{
    public function getModel()
    {
        return ChiTietSua::class;
    }

    public function updateWhenConfirmed($id)
    {
        // foreach ($vanphongpham as $id_vanphongpham => $item) {
        //     $this->model->where('id_phieu', $id_phieu)->where('id_vanphongpham', $id_vanphongpham)
        //         ->update(['cost'=> $item['cost']]);
        // }
    }
}
