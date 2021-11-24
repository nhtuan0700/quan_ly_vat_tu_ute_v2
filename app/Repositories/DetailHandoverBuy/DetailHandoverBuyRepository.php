<?php

namespace App\Repositories\DetailHandoverBuy;

use App\Exceptions\HandoverOverQtyException;
use App\Models\DetailHandoverBuy;
use App\Repositories\DetailBuy\DetailBuyInterface;

class DetailHandoverBuyRepository implements DetailHandoverBuyInterface
{
    private $detailBuyInterface;
    protected $model;

    public function __construct()
    {
        $this->detailBuyInterface = app(DetailBuyInterface::class);
        $this->model = app(DetailHandoverBuy::class);
    }

    public function create($id_handover_note, $id_request_note, $stationeries)
    {
        foreach ($stationeries as $id_stationery => $qty) {
            $detail_buy = $this->detailBuyInterface->findItem($id_request_note, $id_stationery)->firstOrFail();
            if ($qty > $detail_buy->qty - $detail_buy->qty_handovered) {
                throw new HandoverOverQtyException();
            }
            $data = [
                'id_note' => $id_handover_note,
                'id_stationery' => $id_stationery,
                'qty' => intval($qty)
            ];
            $this->model->create($data);
        }
    }
}
