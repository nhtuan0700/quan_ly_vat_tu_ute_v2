<?php

namespace App\Services;

use App\Jobs\SendEmailProcessLimitDefault;
use App\Models\Role;
use App\Repositories\LimitStationery\LimitStationeryInterface;
use App\Repositories\LogLimit\LogLimitInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LimitStationeryService
{
    private $limitRepo;
    private $userRepo;
    private $logLimitRepo;

    public function __construct(
        LimitStationeryInterface $limitStationeryInterface,
        UserInterface $userInterface,
        LogLimitInterface $logLimitInterface
    ) {
        $this->limitRepo = $limitStationeryInterface;
        $this->userRepo = $userInterface;
        $this->logLimitRepo = $logLimitInterface;
    }

    public function getLimitRepo()
    {
        return $this->limitRepo;
    }

    public function update(Request $request, $id_user)
    {
        DB::transaction(function () use ($request, $id_user) {
            $is_edit = false;
            $limit_data['id_user'] = $id_user;
            foreach ($request->limits as $id_stationery => $qty_max) {
                $limit = $this->limitRepo->findItem($id_user, $id_stationery);
                if ($limit->first()->qty_max != $qty_max) {
                    $limit->update([
                        'qty_update' => $qty_max
                    ]);
                    $limit_data['stationeries'][] = [
                        'id_stationery' => $id_stationery,
                        'qty_current' => intval($limit->first()->qty_max),
                        'qty_max' => $qty_max,
                    ];
                    $is_edit = true;
                }
            }

            if ($is_edit) {
                $file =  $request->file('file')->store(sprintf('file'), 'public');
                $log_limit = [
                    'id_updater' => auth()->id(),
                    'data' => json_encode($limit_data),
                    'file' => $file,
                    'edit_user' => true
                ];
                $this->logLimitRepo->create($log_limit);
                $users = $this->userRepo->where('id_role', Role::HANDLER_LIMIT)->get();
                SendEmailProcessLimitDefault::dispatch($users);
            }
        });
    }
}
