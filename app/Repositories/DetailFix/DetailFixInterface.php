<?php

namespace App\Repositories\DetailFix;

use App\Repositories\RepositoryInterface;

interface DetailFixInterface extends RepositoryInterface
{
    public function findItem($id_note, $id_stationery);
    public function updateHandovered($id_note, $equipments);
}
