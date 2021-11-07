<?php

namespace App\Repositories\DotDangKy;

use App\Repositories\RepositoryInterface;

interface DotDangKyInterface extends RepositoryInterface
{
    public function checkComingExist();
    public function getDotDangKyNow();
}
