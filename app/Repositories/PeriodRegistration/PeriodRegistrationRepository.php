<?php

namespace App\Repositories\PeriodRegistration;

use App\Models\PeriodRegistration;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class PeriodRegistrationRepository extends BaseRepository implements PeriodRegistrationInterface
{
    public function getModel()
    {
        return PeriodRegistration::class;
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

    public function checkComing()
    {
        $is_exist = $this->model->where('start_time', '>=', now())->exists();
        return $is_exist;
    }

    public function getItemNow()
    {
        return $this->model->where('start_time', '<=', now())->where('end_time', '>=', now())->first();
    }

    public function list()
    {
        return $this->model->where('start_time', '<=', now())->orderby('end_time', 'desc')->get();
    }

    public function listHasNoteInDepartment()
    {
        return $this->model->query()->whereIn('id', function ($query) {
            $query->select('id_period')->from('request_note')
                ->where('is_buy', true)
                ->where('id_department', auth()->user()->id_department);
        })->get();
    }
}
