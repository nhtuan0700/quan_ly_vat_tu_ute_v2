<?php

namespace App\Repositories\LogLimit;

use App\Models\LogLimit;
use App\Repositories\BaseRepository;

class LogLimitRepository extends BaseRepository implements LogLimitInterface
{

    public function getModel()
    {
        return LogLimit::class;
    }

    public function list() {
        return $this->model->orderby('id', 'desc')->paginate($this->limit);
    }
}
