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

    public function findItem($id_note, $id_equipment)
    {
        return $this->model->where('id_note', $id_note)->where('id_equipment', $id_equipment);
    }

    public function updateHandovered($id_note, $equipments)
    {
        foreach ($equipments as $item) {
            $this->findItem($id_note, $item->id_equipment)
                ->update(['is_handovered' => true]);
        }
    }
}
