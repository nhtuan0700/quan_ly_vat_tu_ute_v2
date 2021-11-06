<?php

namespace App\Repositories\HanMuc;

use App\Repositories\RepositoryInterface;

interface HanMucInterface extends RepositoryInterface
{
    public function findItem($id_user, $id_vanphongpham);
    public function listHanMucByUser($id_user);
}
