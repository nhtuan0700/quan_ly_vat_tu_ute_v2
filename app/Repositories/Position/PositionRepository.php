<?php

namespace App\Repositories\Position;

use App\Models\Position;
use App\Repositories\BaseRepository;

class PositionRepository extends BaseRepository implements PositionInterface
{
    public function getModel()
    {
        return Position::class;   
    }
}