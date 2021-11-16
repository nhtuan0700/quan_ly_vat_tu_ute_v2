<?php

namespace App\Repositories\Registration;

use App\Repositories\RepositoryInterface;

interface RegistrationInterface extends RepositoryInterface
{
    public function listByUser($id_period, $id_user);
    public function listByDepartment($id_period, $id_departmentm, $id_note = null);
    public function sumStationeryByDepartment($id_period, $id_donvi);
    public function findItem($id_user, $id_vanphongpham, $id_period);
    public function updateAfterCreated($id_period, $id_department, $id_note);
}
