<?php

namespace App\Repositories\ThietBi;

use App\Repositories\RepositoryInterface;

interface ThietBiInterface extends RepositoryInterface
{
    public const NORMAL = 1;
    public const FIXING = 2;
    public const BROKEN = 3;
    public function getAutoId();
}
