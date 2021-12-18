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

    public function findItem($id_note, $id_stationery)
    {
        return $this->model->where('id_note', $id_note)->where('id_stationery', $id_stationery);
    }

    public function updateWhenConfirmed($id_note, $stationeries)
    {
        foreach ($stationeries as $id_stationery => $item) {
            $this->findItem($id_note, $id_stationery)
                ->update([
                    'cost' => $item['cost'],
                    'pay_at' => now()
                ]);
        }
    }

    public function updateQtyHandovered($id_note, $stationeries)
    {
        foreach ($stationeries as $item) {
            $this->findItem($id_note, $item->id_stationery)
                ->increment('qty_handovered', $item->qty);
        }
    }
}
