<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LimitStationeryService;

class LimitStationeryController extends Controller
{
    private $limitService;
    private $limitRepo;

    public function __construct(
        LimitStationeryService $limitStationeryService
    ) {
        $this->limitService = $limitStationeryService;
        $this->limitRepo = $limitStationeryService->getLimitRepo();
    }
    
    public function index()
    {
        $limit_stationeries = $this->limitRepo->listByUser(auth()->id());
        return view('limit_stationery.index', compact('limit_stationeries'));
    }

    public function update(Request $request, $id_user)
    {
        try {
            $limit_stationeries = $this->limitRepo->listByUser($id_user);
            $limit_updating = $limit_stationeries->contains(function ($item, $key) {
                return !is_null($item->qty_update) && $item->qty_update > 0;
            });
            if ($limit_updating) {
                return back()->with('alert-fail', 'Không thể yêu cầu cập nhật');
            }
            if (!$request->hasFile('file')) {
                return back()->with('alert-fail', 'Chưa có minh chứng!');
            }

            $this->limitService->update($request, $id_user);
        } catch (\Throwable $th) {
            return back()->with('alert-fail', 'Yêu cầu cập nhật thất bại');
        }
        return back()->with('alert-success', 'Yêu cầu cập nhật thành công <br/> Vui lòng chờ duyệt!');
    }
}
