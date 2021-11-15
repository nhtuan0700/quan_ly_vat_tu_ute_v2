<?php

namespace App\Repositories\Equipment;

use App\Repositories\RepositoryInterface;

interface EquipmentInterface extends RepositoryInterface
{
    public const NORMAL = 1;
    public const FIXING = 2;
    public const BROKEN = 3;
    public function getAutoId();
}
