<?php
namespace App\Repositories\ThietBi;

use App\Models\ThietBi;
use App\Repositories\BaseRepository;

class ThietBiRepository extends BaseRepository implements ThietBiInterface
{
    public function getModel()
    {
        return ThietBi::class;
    }

    public function getAutoId()
    {
        $prefix = 'TB' ;
        $last_field = $this->model->where('ID', 'like', "$prefix%")->orderby('ID', 'desc')->first();
        if (!$last_field) {
            $count = str_pad(1, 6, '0', STR_PAD_LEFT);
        } else {
            $count = intval(substr($last_field->id, -6)) + 1;
            $count = str_pad($count, 6, '0', STR_PAD_LEFT);
        }
        $new_id = $prefix . $count;
        return $new_id;
    }

    public function paginate($direction = 'desc', $limit = NULL)
    {
        $limit = $limit ?? $this->limit;
        return $this->model->orderBy('created_at', $direction)->paginate($limit);
    }

    public function create($attributes = [])
    {
        $attributes['id'] = $attributes['id'] ?? $this->getAutoId();
        return parent::create($attributes);
    }
}