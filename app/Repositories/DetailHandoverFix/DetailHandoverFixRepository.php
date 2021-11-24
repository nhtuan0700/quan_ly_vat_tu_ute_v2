<?php

namespace App\Repositories\DetailHandoverFix;

use App\Models\DetailHandoverFix;
use App\Exceptions\HandoverOverQtyException;
use App\Repositories\DetailFix\DetailFixInterface;

class DetailHandoverFixRepository implements DetailHandoverFixInterface
{
    private $detailFixRepo;
    protected $model;

    public function __construct()
    {
        $this->detailFixRepo = app(DetailFixInterface::class);
        $this->model = app(DetailHandoverFix::class);
    }

    public function create($id_handover_note, $id_request_note, $equipments)
    {
        foreach ($equipments as $id_equipment => $status) {
            $detail_fix = $this->detailFixRepo->findItem($id_request_note, $id_equipment)->firstOrFail();
            if ($detail_fix->is_handovered) {
                throw new HandoverOverQtyException();
            }
            $data = [
                'id_note' => $id_handover_note,
                'id_equipment' => $id_equipment,
            ];
            $this->model->create($data);
        }
    }
}
