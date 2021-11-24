<?php

namespace App\Repositories\HandoverNote;

use App\Models\HandoverNote;
use App\Repositories\BaseRepository;
use App\Repositories\HandoverNote\HandoverNoteInterface;

class HandoverNoteRepository extends BaseRepository implements HandoverNoteInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return HandoverNote::class;
    }

    public function getAutoId()
    {
        $now = now();
        $code = 'BG';
        $month = $now->format('m');
        $year = $now->format('y');
        $prefix = $code . $month . $year;
        $last_field = $this->model->where('id', 'like', "$prefix%")->orderby('id', 'desc')->first();
        if (!$last_field) {
            $count = str_pad(1, 3, '0', STR_PAD_LEFT);
        } else {
            $count = intval(substr($last_field->id, -3)) + 1;
            $count = str_pad($count, 3, '0', STR_PAD_LEFT);
        }
        $new_id = $prefix . $count;
        return $new_id;
    }

    public function create($attributes = [])
    {
        $attributes ['id'] = $this->getAutoId();

        return parent::create($attributes);
    }
}
