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
            $count = intval(substr($last_field->ID, -3)) + 1;
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
        $new_phieu = parent::create($attributes);
        return $new_phieu;
    }

    public function listPhieuMuaDonVi($id_donvi)
    {
        return $this->model->phieumua()->orderby('created_at', 'desc')->paginate($this->limit);
    }

    public function find_mua($id)
    {
        return $this->model->where('id', $id)->where('is_mua', true)->firstOrFail();
    }
}
