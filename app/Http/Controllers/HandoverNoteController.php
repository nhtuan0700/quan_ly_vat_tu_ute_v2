<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HandoverNoteService;
use App\Exceptions\HandoverOverQtyException;
use App\Exceptions\HandoverListSuppliesException;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Gate;

class HandoverNoteController extends Controller
{
    private $handoverNoteRepo;
    private $requestNoteRepo;
    private $handoverNoteService;

    public function __construct(
        HandoverNoteService $handoverNoteService
    ) {
        $this->handoverNoteService = $handoverNoteService;
        $this->handoverNoteRepo = $handoverNoteService->getHandoverNoteRepo();
        $this->requestNoteRepo = $handoverNoteService->getRequestNoteRepo();
    }

    public function index(Request $request)
    {
        $limit = config('constants.limit_page');
        $notes = $this->handoverNoteRepo->query()
            ->when($request->id, function ($query) use ($request) {
                return $query->where('id', $request->id);
            })
            ->when($request->id_request_note, function ($query) use ($request) {
                return $query->where('id_request_note', $request->id_request_note);
            })
            ->orderby('created_at', 'desc')
            ->paginate($limit)->withQueryString();
        return view('handover_note.index', compact('notes'));
    }

    public function create($id)
    {
        $request_note = $this->requestNoteRepo->findOrFail($id);
        $this->authorize('create_handover', $request_note);
        return view('handover_note.create', compact('request_note'));
    }

    public function store($id_request_note, Request $request)
    {
        $request_note = $this->requestNoteRepo->findOrFail($id_request_note);
        $this->authorize('create_handover', $request_note);
        try {
            $new_note = $this->handoverNoteService->store($request_note, $request);
            return redirect(route('handover_note.detail', ['id' => $new_note->id]))
                ->with('alert-success', trans('alert.create.success'));
        } catch (HandoverListSuppliesException $e) {
            return back()->with('alert-fail', $e->getMessage());
        } catch (HandoverOverQtyException $e) {
            return back()->with('alert-fail', $e->getMessage());
        }
    }

    public function detail($id)
    {
        $note = $this->handoverNoteRepo->findOrFail($id);
        return view('handover_note.detail', compact('note'));
    }

    public function detail_ajax($id)
    {
        if (Gate::allows('handover_note-manage')) {
            $note = $this->handoverNoteRepo->find($id);
        } else {
            // Nếu phiếu mua thì so sánh đơn vị
            // Phiếu sửa thì so sánh người tạo phiếu
            $note = $this->handoverNoteRepo->query()->whereHas('request_note', function ($query) {
                $query->where(function ($query) {
                    $query->where('is_buy', true)->where('id_department', auth()->user()->id_department);
                })->orWhere(function ($query) {
                    $query->where('is_buy', false)->where('id_creator', auth()->id());
                });
            })->where('id', $id)->first();
        }
        if (!is_null($note)) {
            $html = view('handover_note.components.modal_detail_sub', compact('note'))->render();
        } else {
            $html = '<h5 class="text-danger">Không tìm thấy thông tin phiếu</h5>';
        }
        return response()->json(
            [
                'html' => $html
            ]
        );
    }

    public function edit($id)
    {
        $note = $this->handoverNoteRepo->findOrFail($id);
        $this->authorize('update', $note);
        return view('handover_note.edit', compact('note'));
    }

    public function update($id, Request $request)
    {
        $handover_note = $this->handoverNoteRepo->findOrFail($id);
        $this->authorize('update', $handover_note);
        try {
            $this->handoverNoteService->update($handover_note, $request);
            return redirect(route('handover_note.detail', ['id' => $id]))
                ->with('alert-success', trans('alert.update.success'));
        } catch (HandoverListSuppliesException $e) {
            return back()->with('alert-fail', $e->getMessage());
        } catch (HandoverOverQtyException $e) {
            return back()->with('alert-fail', $e->getMessage());
        }
    }

    public function confirm($id)
    {
        $handover_note = $this->handoverNoteRepo->findOrFail($id);
        $this->authorize('confirm', $handover_note);
        $this->handoverNoteService->confirm($handover_note);
        return back()->with('alert-success', 'Xác nhận phiếu thành công');
    }

    public function delete($id)
    {
        $note = $this->handoverNoteRepo->findOrFail($id);
        $this->authorize('delete', $note);
        $note->delete();
        DatabaseNotification::whereJsonContains('data->id_handover_note', $id)->delete();
        return back()->with('alert-success', trans('alert.delete.success'));
    }

    public function print($id)
    {
        $note = $this->handoverNoteRepo->find($id);
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $pdf->loadHTML(view('handover_note.pdf', compact('note')));
        return $pdf->stream();
    }
}
