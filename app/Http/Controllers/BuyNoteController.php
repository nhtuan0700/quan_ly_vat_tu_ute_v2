<?php

namespace App\Http\Controllers;

use App\Services\BuyNoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyNoteController extends Controller
{
    private $buyNoteRepo;
    private $buyNoteService;
    private $registrationRepo;
    private $periodRepo;

    public function __construct(
        BuyNoteService $buyNoteService
    ) {
        $this->buyNoteService = $buyNoteService;
        $this->buyNoteRepo = $buyNoteService->getBuyNoteRepo();
        $this->periodRepo = $buyNoteService->getPeriodRepo();
        $this->registrationRepo = $buyNoteService->getRegistrationRepo();
    }

    public function index()
    {
        $notes = $this->buyNoteRepo->listBuyNoteByDepartment();
        return view('buy_note.index', compact('notes'));
    }

    public function list_period()
    {
        $periods = $this->periodRepo->list();
        return view('buy_note.list_period', compact('periods'));
    }

    public function create($id_period)
    {
        $period = $this->periodRepo->findOrFail($id_period);
        // Kiểm tra đợt đăng ký sắp | đang diễn ra
        if (now() <= $period->getRawOriginal('end_time')) {
            $message = 'Vui lòng chờ đợt đăng ký kết thúc mới được tổng hợp đăng ký';
            return view('buy_note.create_fail', compact('message'));
        }
        // Kiểm tra đợt đăng ký đã có phiếu chưa
        if (!!$period->getBuyNoteDepartment()) {
            return redirect(route('buy_note.detail', ['id' => $period->getBuyNoteDepartment()->id]));
        };
        $id_department = auth()->user()->id_department;
        $sum_stationeries = $this->registrationRepo->sumStationeryByDepartment($id_period, $id_department);
        $depm_registations = $this->registrationRepo->listByDepartment($id_period, $id_department);
        return view('buy_note.create', compact('sum_stationeries', 'depm_registations', 'id_period'));
    }

    public function store(Request $request, $id_period)
    {
        $period = $this->periodRepo->findOrFail($id_period);
        if (now() <= $period->getRawOriginal('end_time') || !!$period->getBuyNoteDepartment()) {
            return redirect(route('buy_note.create', ['id_period' => $id_period]));
        }
        try {
            $new_note = $this->buyNoteService->store($request, $id_period);
            return redirect(route('buy_note.detail', ['id' => $new_note->id]))
                ->with('alert-success', trans('alert.create.success'));
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return back()
                ->with('alert-fail', trans('alert.create.fail'));
        }
    }

    public function detail($id)
    {
        $note = $this->buyNoteRepo->find_buy_note($id);
        $this->authorize('view_buy', $note);
        $depm_registations = $this->registrationRepo->listByDepartment(
            $note->id_period,
            $note->id_department,
            $note->id
        );
        return view('buy_note.detail', compact('note', 'depm_registations'));
    }

    public function search(Request $request)
    {
        $notes = $this->buyNoteRepo->search2($request, true);
        return view('buy_note.index', compact('notes'));
    }
}
