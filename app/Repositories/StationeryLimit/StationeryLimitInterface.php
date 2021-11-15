<?php

namespace App\Repositories\StationeryLimit;

use App\Repositories\RepositoryInterface;

interface StationeryLimitInterface extends RepositoryInterface
{
    public function findItem($id_user, $id_vanphongpham);
    public function listHanMucByUser($id_user);
}
