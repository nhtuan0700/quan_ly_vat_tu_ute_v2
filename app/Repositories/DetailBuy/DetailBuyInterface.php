<?php

namespace App\Repositories\DetailBuy;

use App\Repositories\RepositoryInterface;

interface DetailBuyInterface extends RepositoryInterface
{
    public function findItem($id_note, $id_stationery);
    public function updateWhenConfirmed($id_note, $stationeries);
    public function updateQtyHandovered($id_note, $stationeries);
}
