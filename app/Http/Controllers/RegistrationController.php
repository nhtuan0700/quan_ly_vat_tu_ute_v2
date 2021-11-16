<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RegistrationService;
use App\Exceptions\OverLimitStationeryException;
use App\Http\Requests\Registration\SaveRegistration;

class RegistrationController extends Controller
{
    private $limitRepo;
    private $periodRepo;
    private $registrationRepo;
    private $registrationService;

    public function __construct(
        RegistrationService $registrationService
    ) {
        $this->registrationService = $registrationService;
        $this->limitRepo = $registrationService->getLimitRepo();
        $this->periodRepo = $registrationService->getPeriodRepo();
        $this->registrationRepo = $registrationService->getRegistrationRepo();
    }

    public function index()
    {
        $period = $this->periodRepo->getItemNow();
        if (!$period) {
            return view('registration.not_found');
        }
        $limits = $this->limitRepo->listByUser(auth()->id());
        $registrations = $this->registrationRepo->listByUser($period->id, auth()->id());
        return view('registration.index', compact('limits', 'period', 'registrations'));
    }

    public function save(SaveRegistration $request)
    {
        try {
            $this->registrationService->save($request);
            return back()->with('alert-success', 'Đăng ký thành công');
        } catch (OverLimitStationeryException $e) {
            return back()->with('alert-fail', 'Số lượng vượt quá hạn mức');
        }
    }

    public function history($id_period = null)
    {
        if (is_null($id_period)) {
            $periods = $this->periodRepo->list();
            return view('history.list_period', compact('periods'));
        }
        $period = $this->periodRepo->findOrFail($id_period);
        $registrations = $this->registrationRepo->listByUser($id_period, auth()->id());
        return view('history.detail', compact('registrations', 'id_period'));
    }
}
