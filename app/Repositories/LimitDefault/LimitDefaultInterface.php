<?php

namespace App\Repositories\LimitDefault;


interface LimitDefaultInterface
{
    public function getListStationery($id_department, $id_position);
    public function update($data);
    public function where($column, $value);
    public function findItem($id_department, $id_position, $id_stationery);

    public function create($data);
}
