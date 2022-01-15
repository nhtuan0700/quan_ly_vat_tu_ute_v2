<?php

namespace App\Http\Controllers;

use App\Notifications\UpdateLimitStationeryNotification;
use App\Repositories\LimitStationery\LimitStationeryInterface;
use App\Repositories\LogLimit\LogLimitInterface;
use App\Repositories\Stationery\StationeryInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ProcessLimitController extends Controller
{
    private $logLimitRepo;
    private $userRepo;
    private $stationeryRepo;
    private $limitRepo;

    public function __construct(
        LogLimitInterface $logLimitInterface,
        LimitStationeryInterface $limitStationeryInterface,
        UserInterface $userInterface,
        StationeryInterface $stationeryInterface
    ) {
        $this->logLimitRepo = $logLimitInterface;
        $this->limitRepo = $limitStationeryInterface;
        $this->userRepo = $userInterface;
        $this->stationeryRepo = $stationeryInterface;
    }

    public function index()
    {
        $logs = $this->logLimitRepo->list();
        return view('process_limit.index', compact('logs'));
    }

    public function detail($id)
    {
        $log = $this->logLimitRepo->findOrFail($id);
        $log_data = json_decode($log->data);
        $user = $this->userRepo->findOrFail($log_data->id_user);
        $stationeries = [];
        foreach ($log_data->stationeries as $item) {
            $stationery = $this->stationeryRepo->find($item->id_stationery);
            $limit = $this->limitRepo->findItem($user->id, $item->id_stationery);
            if ($stationery) {
                $stationeries[] = [
                    'id_stationery' => $stationery->id,
                    'name' => $stationery->name,
                    'unit' => $stationery->unit,
                    'qty_max' => intval($item->qty_current),
                    'qty_max_updating' => intval($item->qty_max),
                ];
            }
        }
        return view('process_limit.detail', compact('log', 'stationeries', 'user'));
    }

    public function confirm($id)
    {
        $log = $this->logLimitRepo->findOrFail($id);
        $this->authorize('process',$log);
        $log_data = json_decode($log->data);
        $id_user = $log_data->id_user;
        foreach ($log_data->stationeries as $item) {
            $limit = $this->limitRepo->findItem($id_user, $item->id_stationery);
            if ($limit->first()) {
                $limit->update([
                    'qty_max' => $item->qty_max,
                    'qty_update' => null
                ]);
            }
        }
        $log->update([
            'id_confirmer' => auth()->id(),
            'is_confirm' => true,
            'processed_at' => now()
        ]);
        Notification::send($this->userRepo->find($id_user), new UpdateLimitStationeryNotification());
        return back()->with('alert-success', 'Xử lý thành công');
    }

    public function reject($id)
    {
        $log = $this->logLimitRepo->findOrFail($id);
        $this->authorize('process',$log);
        $log_data = json_decode($log->data);
        $id_user = $log_data->id_user;
        foreach ($log_data->stationeries as $item) {
            $limit = $this->limitRepo->findItem($id_user, $item->id_stationery);
            if ($limit->first()) {
                $limit->update([
                    'qty_update' => null
                ]);
            }
        }
        $log->update([
            'id_confirmer' => auth()->id(),
            'is_confirm' => false,
            'processed_at' => now()
        ]);

        return back()->with('alert-success', 'Xử lý thành công');
    }
}
