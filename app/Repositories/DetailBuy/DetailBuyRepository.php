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

    public function updateWhenConfirmed($id_note, $stationeries)
    {
        foreach ($stationeries as $id_stationery => $item) {
            $this->model->where('id_note', $id_note)->where('id_stationery', $id_stationery)
                ->update(['cost' => $item['cost']]);
        }
    }
}
