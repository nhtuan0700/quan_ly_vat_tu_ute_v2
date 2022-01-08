<?php

namespace App\Repositories\LogLimit;

use App\Repositories\RepositoryInterface;

interface LogLimitInterface extends RepositoryInterface
{
    public function list();
}
