<?php
namespace App\Repositories\DotDangKy;

use App\Models\DotDangKy;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class DotDangKyRepository extends BaseRepository implements DotDangKyInterface
{
    public function getModel()
    {
        return DotDangKy::class;
    }

    private function getAutoId()
    {
        $now = Carbon::now();
        $year = $now->format('y');
        $last_field = $this->model->where('id', 'like', "%$year")->orderby('created_at', 'desc')->first();
        if (!$last_field) {
            $count = 1;
        } else {
            $count = intval(substr($last_field->id, 0, -2)) + 1;
        }
        $new_id = $count . $year;
        return $new_id;
    }

    public function paginate($direction = 'desc', $limit = NULL)
    {
        $limit = $limit ?? $this->limit;
        return $this->model->orderBy('created_at', $direction)->paginate($limit);
    }

    public function create($attributes = [])
    {
        $attributes['id'] = $this->getAutoId();
        return parent::create($attributes);
    }

    public function checkComingExist()
    {
        $is_exist = $this->model->where('start_at', '>=', now())->exists();
        return $is_exist;
    }

    public function getDotDangKyNow()
    {
        return $this->model->where('start_at', '<=', now())->where('end_at', '>=', now())->first();
    }
}