<?php

namespace App\Http\Controllers;

use App\Repositories\PeriodRegistration\PeriodRegistrationInterface;
use App\Repositories\Registration\RegistrationInterface;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class HandoverRegistrationController extends Controller
{
    private $periodRepo;
    private $registrationRepo;
    private $userRepo;

    public function __construct(
        RegistrationInterface $registrationInterface,
        UserInterface $userInterface,
        PeriodRegistrationInterface $periodRegistrationInterface
    ) {
        $this->userRepo = $userInterface;
        $this->periodRepo = $periodRegistrationInterface;
        $this->registrationRepo = $registrationInterface;
    }

    public function list_period()
    {
        $periods = $this->periodRepo->listHasNoteInDepartment();
        return view('handover_registration.list_period', compact('periods'));
    }

    public function list_user($id_period)
    {
        $period = $this->periodRepo->findOrFail($id_period);
        $id_note = $period->getBuyNoteDepartment()->id;
        $users = $this->userRepo->query()
            ->whereIn('id', function ($query) use ($id_note) {
                $query->select('id_user')->from('registration')
                    ->where('id_note', $id_note);
            })->get();
        return view('handover_registration.list_user', compact('users', 'id_period'));
    }

    public function detail(Request $request)
    {
        $period = $this->periodRepo->findOrFail($request->id_period);
        $registrations = $this->registrationRepo->listByUser($request->id_period, $request->id_user);
        $user = $this->userRepo->findOrFail($request->id_user);
        return view('handover_registration.detail', compact('registrations', 'user'));
    }

    public function handover(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stationeries' => 'required',
        ]);
        if ($validator->fails()) {
            session()->flash('alert-fail', 'Danh sách bàn giao không để trống');
            throw new ValidationException($validator);
        };
        DB::transaction(function () use ($request) {
            foreach ($request->stationeries as $id_stationery => $value) {
                $registration = $this->registrationRepo
                    ->findItem($request->id_user, $id_stationery, $request->id_period);
                $this->authorize('handover', $registration->firstOrFail());
                $registration->update([
                    'received_at' => now()
                ]);
            }
        });

        return back()->with('alert-success', 'Bàn giao thành công');
    }
}
