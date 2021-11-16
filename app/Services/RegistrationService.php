<?php

namespace App\Services;

use App\Exceptions\OverLimitStationeryException;
use App\Http\Requests\Registration\SaveRegistration;
use App\Repositories\LimitStationery\LimitStationeryInterface;
use App\Repositories\Registration\RegistrationInterface;
use App\Repositories\PeriodRegistration\PeriodRegistrationInterface;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    private $limitRepo;
    private $periodRepo;
    private $registrationRepo;

    public function __construct(
        LimitStationeryInterface $limitStationeryInterface,
        PeriodRegistrationInterface $periodRegistrationInterface,
        RegistrationInterface $registrationInterface
    ) {
        $this->limitRepo = $limitStationeryInterface;
        $this->periodRepo = $periodRegistrationInterface;
        $this->registrationRepo = $registrationInterface;
    }

    public function getPeriodRepo()
    {
        return $this->periodRepo;
    }
    public function getLimitRepo()
    {
        return $this->limitRepo;
    }
    public function getRegistrationRepo()
    {
        return $this->registrationRepo;
    }

    public function save(SaveRegistration $request)
    {
        $id_period = $this->periodRepo->getItemNow()->id;
        $registrations = $this->registrationRepo->listByUser($id_period, auth()->id());
        DB::transaction(function () use ($request, $registrations, $id_period) {
            // Reset hạn mức đã dăng ký ban đâu, sau đó xóa các đăng ký cũ
            foreach ($registrations as $item) {
                $limit = $this->limitRepo->findItem(auth()->id(), $item->id);
                $limit->decrement('qty_used', $item->qty);
                $this->registrationRepo->findItem(auth()->id(), $item->id, $id_period)->delete();
            }
            // Thêm lại các đăng ký
            if ($request->stationeries) {
                foreach ($request->stationeries as $id_stationery => $qty) {
                    $limit = $this->limitRepo->findItem(auth()->id(), $id_stationery);
                    if (($limit->first()->qty_remain) < $qty) {
                        throw new OverLimitStationeryException();
                    };
                    $this->registrationRepo->create([
                        'id_user' => auth()->id(),
                        'id_stationery' => $id_stationery,
                        'id_period' => $id_period,
                        'qty' => $qty
                    ]);
                    $limit->increment('qty_used', $qty);
                }
            }
        });
    }
}
