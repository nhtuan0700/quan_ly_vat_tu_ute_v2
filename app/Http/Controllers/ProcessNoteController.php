<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ProcessNoteService;
use Illuminate\Support\Facades\Config;
use App\Exceptions\UpdateDetailFixException;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProcessNoteNotification;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\FixNote\UpdateDetailFixRequest;

class ProcessNoteController extends Controller
{
    private $processService;
    private $noteRepo;
    private $registrationRepo;

    public function __construct(
        ProcessNoteService $processNoteService
    ) {
        $this->processService = $processNoteService;
        $this->noteRepo = $processNoteService->getNoteRepo();
        $this->registrationRepo = $processNoteService->getRegistrationRepo();
    }

    public function index(Request $request)
    {
        $limit = config('constants.limit_page');
        $notes = $this->noteRepo->query()->with('detail_buy', 'detail_fix')->with('department')
            ->when($request->status, function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->when($request->id, function ($query) use ($request) {
                return $query->where('id', $request->id);
            })
            ->when(!is_null($request->category), function ($query) use ($request) {
                return $query->where('is_buy', !!$request->category);
            })
            ->orderby('status', 'asc')
            ->orderby('created_at', 'desc')
            ->paginate($limit)->withQueryString();
        return view('process_note.index', compact('notes'));
    }

    public function detail($id)
    {
        $note = $this->noteRepo->find($id);
        if ($note->is_buy) {
            $depm_registrations = $this->registrationRepo->listByDepartment(
                $note->id_period,
                $note->id_department,
                $note->id
            );
            if (!!$note->id_handler) {
                return view('process_note.detail_processed.buy', compact('note', 'depm_registrations'));
            }
            return view('process_note.detail_unprocess.buy', compact('note', 'depm_registrations'));
        }
        if (!!$note->id_handler) {
            return view('process_note.detail_processed.fix', compact('note'));
        }
        return view('process_note.detail_unprocess.fix', compact('note'));
    }

    public function confirm(Request $request, $id)
    {
        $note = $this->noteRepo->find($id);
        $this->authorize('confirm', $note);
        try {
            $this->processService->confirm($request, $note);
            Notification::send(User::find($note->id_creator), new ProcessNoteNotification($note));
        } catch (ValidationException $e) {
            return back();
        } catch (\Throwable $th) {
            // return ($th->getMessage());
            return back()->with('alert-fail', 'Xử lý phiếu thất bại');
        }
        return redirect(route('process_note.detail', ['id' => $id]))
            ->with('alert-success', 'Xử lý phiếu thành công');
    }

    public function reject($id)
    {
        $note = $this->noteRepo->findOrFail($id);
        $this->authorize('reject', $note);
        try {
            $this->processService->reject($note);
            Notification::send(User::find($note->id_creator), new ProcessNoteNotification($note));
        } catch (\Throwable $th) {
            // return ($th->getMessage());
            return back()->with('alert-fail', 'Xử lý phiếu thất bại');
        }
        return redirect(route('process_note.detail', ['id' => $id]))
            ->with('alert-success', 'Xử lý phiếu thành công');
    }

    public function update_detail_fix(UpdateDetailFixRequest $request, $id)
    {
        $note = $this->noteRepo->findOrFail($id);
        $this->authorize('update_detail_fix', $note);
        try {
            $this->processService->update_detail_fix($request, $id);
            return redirect(route('process_note.detail', ['id' => $id]))
                ->with('alert-success', 'Cập nhật phiếu thành công');
        } catch (UpdateDetailFixException $e) {
            return back()->with('alert-fail', $e->getMessage());
        } catch (\Throwable $th) {
            return ($th->getMessage());
            return back()->with('alert-fail', 'Cập nhật phiếu thất bại');
        }
    }
}
