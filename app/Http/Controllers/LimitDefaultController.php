<?php

namespace App\Http\Controllers;

use App\Models\Stationery;
use App\Repositories\Department\DepartmentInterface;
use App\Repositories\LimitDefault\LimitDefaultInterface;
use App\Repositories\Position\PositionInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LimitDefaultController extends Controller
{
    private $limitDefaultRepo;
    private $departmentRepo;
    private $positionRepo;

    public function __construct(
        LimitDefaultInterface $limitDefaultInterface,
        DepartmentInterface $departmentInterface,
        PositionInterface $positionInterface
    ) {
        $this->limitDefaultRepo = $limitDefaultInterface;
        $this->departmentRepo = $departmentInterface;
        $this->positionRepo = $positionInterface;
    }

    public function index()
    {
        $departments = $this->departmentRepo->all();
        $positions = $this->positionRepo->all();
        return view('limit_default.index', compact('departments', 'positions'));
    }

    public function getListStationery(Request $request)
    {
        $stationeries = $this->limitDefaultRepo->getListStationery($request->id_department, $request->id_position);
        return response()->json($stationeries);
    }

    public function update(Request $request)
    {
        $data = array_map(function ($item) use ($request) {
            $temp_obj['id_department'] = $request->id_department;
            $temp_obj['id_position'] = $request->id_position;
            $temp_obj['id_stationery'] = $item['id'];
            $temp_obj['qty'] = intval($item['qty']);
            return $temp_obj;
        }, $request->stationeries);

        try {
            DB::transaction(function () use ($data) {
                $this->limitDefaultRepo->update($data);
            });
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
        return response()->json($data);
    }
}
