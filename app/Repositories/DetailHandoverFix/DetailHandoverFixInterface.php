<?php

namespace App\Repositories\DetailHandoverFix;

interface DetailHandoverFixInterface
{
    public function create($id_handover_note, $id_request_note, $equipments);
}
