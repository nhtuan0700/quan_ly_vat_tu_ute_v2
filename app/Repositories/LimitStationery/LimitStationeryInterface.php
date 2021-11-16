<?php

namespace App\Repositories\LimitStationery;

use App\Repositories\RepositoryInterface;

interface LimitStationeryInterface extends RepositoryInterface
{
    public function findItem($id_user, $id_vanphongpham);
    public function listByUser($id_user);
}
