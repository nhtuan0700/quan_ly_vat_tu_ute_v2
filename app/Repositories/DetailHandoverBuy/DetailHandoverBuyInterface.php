<?php

namespace App\Repositories\DetailHandoverBuy;


interface DetailHandoverBuyInterface
{
    public function create($id_handover_note, $id_request_note, $stationeries);
}
