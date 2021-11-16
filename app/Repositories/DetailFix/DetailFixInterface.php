<?php

namespace App\Repositories\DetailFix;

use App\Repositories\RepositoryInterface;

interface DetailFixInterface extends RepositoryInterface
{
    public function updateWhenConfirmed($id);
}
