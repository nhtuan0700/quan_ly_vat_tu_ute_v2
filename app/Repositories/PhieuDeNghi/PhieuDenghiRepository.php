<?php

namespace App\Repositories\PhieuDenghi;

use App\Models\PhieuDenghi;
use App\Repositories\BaseRepository;
use App\Repositories\PhieuDenghi\PhieuDenghiInterface;

class PhieuDenghiRepository extends BaseRepository implements PhieuDenghiInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return PhieuDenghi::class;
    }

    public function getAutoId($is_mua = true)
    {
        $now = now();
        $code = $is_mua ? 'PM' : 'PS';
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

    public function create_mua($attributes = [])
    {
        $attributes['id'] = $this->getAutoId(true);
        $attributes['is_mua'] = true;
        $attributes['status'] = self::CONFIRMING;
        $new_phieu = parent::create($attributes);
        return $new_phieu;
    }

    public function create_sua($attributes = [])
    {
        $attributes['id'] = $this->getAutoId(false);
        $attributes['is_mua'] = false;
        $attributes['status'] = self::CONFIRMING;
        $new_phieu = parent::create($attributes);
        return $new_phieu;
    }

    public function listPhieuMuaDonVi()
    {
        return $this->model->phieumua()
            ->where('id_donvi', auth()->user()->id_donvi)
            ->orderby('created_at', 'desc')
            ->paginate($this->limit);
    }

    public function listPhieuSua()
    {
        return $this->model->phieusua()
            ->where('id_creator', auth()->id())
            ->orderby('created_at', 'desc')
            ->paginate($this->limit);
    }

    public function search2($request, $is_mua = true)
    {
        if ($is_mua) {
            $model = $this->model->phieumua()->where('id_donvi', auth()->user()->id_donvi);
        } else {
            $model = $this->model->phieusua()->where('id_creator', auth()->id());
        }
        if ($request->id) {
            $model->where('id', $request->id);
        }
        if ($request->status) {
            $model->where('status', $request->status);
        }
        return $model
            ->orderby('created_at', 'desc')
            ->paginate($this->limit)
            ->appends(request()->all());
    }

    public function find_mua($id)
    {
        return $this->model->phieumua()->where('id', $id)->firstOrFail();
    }
    public function find_sua($id)
    {
        return $this->model->phieusua()->where('id', $id)->firstOrFail();
    }
}
