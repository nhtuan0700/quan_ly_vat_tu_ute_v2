<?php

namespace App\Repositories\PeriodRegistraion;

use App\Models\PeriodRegistraion;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class PeriodRegistraionRepository extends BaseRepository implements PeriodRegistraionInterface
{
    public function getModel()
    {
        return PeriodRegistraion::class;
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
        $is_exist = $this->model->where('start_at', '>=', now())->exists();
        return $is_exist;
    }

    public function getDotDangKyNow()
    {
        return $this->model->where('start_at', '<=', now())->where('end_at', '>=', now())->first();
    }

    public function getDotDangKyLast()
    {
        $dotdk_last = $this->model->where('end_at', '<=', now())->orderby('end_at', 'desc')->first();
        // dd($check);
    }

    /**
     * Load danh sách các đợt đăng ký (đang diễn ra, đã diễn ra) mà đơn vị chưa tạo phiếu
     */
    public function listNotHasPhieu()
    {
        return $this->model->whereNotIn('id', function ($query) {
            $query->select('id_donvi')->from('phieudenghi')
                ->where('is_mua', true)
                ->where('id_donvi', auth()->user()->id_donvi);
        })->where('end_at', '<=', now())->get();
    }

    public function list()
    {
        return $this->model->where('start_at', '<=', now())->orderby('created_at', 'desc')->get();
    }
}
