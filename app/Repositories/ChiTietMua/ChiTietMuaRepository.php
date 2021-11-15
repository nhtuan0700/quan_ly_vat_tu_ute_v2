<?php

namespace App\Repositories\ChiTietMua;

use App\Models\ChiTietMua;
use App\Repositories\BaseRepository;

class ChiTietMuaRepository extends BaseRepository implements ChiTietMuaInterface
{
    public function getModel()
    {
        return ChiTietMua::class;
    }

    public function updateWhenConfirmed($id_phieu, $vanphongpham)
    {
        foreach ($vanphongpham as $id_vanphongpham => $item) {
            $this->model->where('id_phieu', $id_phieu)->where('id_vanphongpham', $id_vanphongpham)
                ->update(['cost'=> $item['cost']]);
        }
    }
}
