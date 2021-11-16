<?php

namespace App\Repositories\Registration;

use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;

class RegistrationRepository extends BaseRepository implements RegistrationInterface
{
    public function getModel()
    {
        return Registration::class;
    }

    public function listByUser($id_period, $id_user)
    {
        return DB::table('registration')
            ->join('stationery', 'stationery.id', '=', 'registration.id_stationery')
            ->join('limit_stationery', 'limit_stationery.id_stationery', '=', 'stationery.id')
            ->where('registration.id_user', $id_user)
            ->where('limit_stationery.id_user', $id_user)
            ->where('registration.id_period', $id_period)
            ->whereNull('stationery.deleted_at')
            ->orderBy('name', 'asc')
            ->select('id', 'name', 'unit', 'qty', 'id_note', 'received_at')
            ->selectRaw('qty_max - qty_used as qty_remain')
            ->get();
    }

    public function listByDepartment($id_period, $id_department, $id_note = null)
    {
        return DB::table('registration')
            ->join('users', 'users.id', '=', 'registration.id_user')
            ->join('department', 'department.id', '=', 'users.id_department')
            ->join('stationery', 'stationery.id', '=', 'registration.id_stationery')
            ->where('registration.id_period', $id_period)
            ->when(is_null($id_note), function ($query) use ($id_department) {
                return $query->where('users.id_department', $id_department)
                    ->whereNull('registration.id_note');
            }, function ($query) use ($id_note) {
                return $query->where('registration.id_note', $id_note);
            })
            ->whereNull('stationery.deleted_at')
            ->orderBy('users.id', 'asc')
            ->select(
                'users.id as id_user',
                'stationery.id as id_stationery',
                'users.name as name_user',
                'stationery.name as name_stationery',
                'unit',
                'qty',
                'received_at',
                'department.name as name_department'
            )
            ->get();
    }

    public function findItem($id_user, $id_stationery, $id_period)
    {
        return $this->model
            ->where('id_user', $id_user)
            ->where('id_stationery', $id_stationery)
            ->where('id_period', $id_period)
            ->select('*')
            ->selectRaw('qty_max - qty_used as qty_remain');
    }

    public function sumStationeryByDepartment($id_period, $id_department)
    {
        return DB::table('registration')
            ->join('users', 'users.id', '=', 'registration.id_user')
            ->join('stationery', 'stationery.id', '=', 'registration.id_stationery')
            ->where('users.id_department', $id_department)
            ->where('registration.id_period', $id_period)
            ->whereNull('registration.id_note')
            ->whereNull('stationery.deleted_at')
            ->select('id_stationery', 'stationery.name', 'unit')
            ->selectRaw('sum(qty) as qty')
            ->groupBy('id_stationery', 'stationery.name', 'unit')
            ->get();
    }

    public function updateAfterCreated($id_period, $id_department, $id_note)
    {
        return $this->model
            ->whereIn('id_user', function ($query) use ($id_department) {
                $query->select('id')->from('users')->where('id_department', $id_department);
            })
            ->whereNull('id_note')
            ->where('id_period', $id_period)
            ->update(['id_note' => $id_note]);
    }
}
