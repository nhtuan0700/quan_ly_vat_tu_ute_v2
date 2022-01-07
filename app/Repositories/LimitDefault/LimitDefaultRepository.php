<?php

namespace App\Repositories\LimitDefault;

use App\Models\LimitDefault;
use App\Models\Stationery;
use App\Repositories\LimitStationery\LimitStationeryInterface;
use App\Repositories\User\UserInterface;

class LimitDefaultRepository implements LimitDefaultInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = app(LimitDefault::class);
    }

    public function where($column, $value)
    {
        return $this->model->where($column, $value);
    }

    public function update($data)
    {
        foreach ($data as $item) {
            $result = $this->findItem($item['id_department'], $item['id_position'], $item['id_stationery']);
            $result->firstOrFail();
            $result->update($item);
            $this->updateLimitUser($item);
        }
    }

    // Limit registration of user
    // Cập nhật hạn mức của use khi cập nhật hạn mức mặc định theo chức vụ
    public function updateLimitUser($data)
    {
        $limitRepo = app(LimitStationeryInterface::class);
        $userRepo = app(UserInterface::class);

        $users = $userRepo
            ->where('id_department', $data['id_department'])
            ->where('id_position', $data['id_position'])
            ->get();
        foreach ($users as $user) {
            $limit = $limitRepo->findItem($user->id, $data['id_stationery']);
            // Kiểm tra nếu hạn mức mặc định của chức vụ lớn hơn 0 
            // và hạn mức văn phòng phẩm của user = 0 thì cập nhật hạn mức mới 
            if ($limit->first()->qty_max === 0 && $data['qty'] > 0) {
                $limit->update([
                    'qty_max' => $data['qty']
                ]);
            }
        }
    }

    public function getListStationery($id_department, $id_position)
    {
        return Stationery::leftjoin('limit_default', function ($join) use ($id_department, $id_position) {
            $join->on('stationery.id', '=', 'limit_default.id_stationery')
                ->where('limit_default.id_department', $id_department)
                ->where('limit_default.id_position', $id_position);
        })
            ->orderby('qty', 'desc')
            ->select('id', 'name', 'unit', 'qty', 'limit_default.updated_at')
            ->get();
    }

    public function findItem($id_department, $id_position, $id_stationery)
    {
        return $this->model
            ->where('id_department', $id_department)
            ->where('id_position', $id_position)
            ->where('id_stationery', $id_stationery);
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }
}
