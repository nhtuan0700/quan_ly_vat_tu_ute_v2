<?php

namespace App\Repositories\DetailFix;

use App\Models\DetailFix;
use App\Repositories\BaseRepository;

class DetailFixRepository extends BaseRepository implements DetailFixInterface
{
    public function getModel()
    {
        return DetailFix::class;
    }
}
