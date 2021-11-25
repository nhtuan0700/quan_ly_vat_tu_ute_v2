<?php

namespace App\Http\Controllers;

use App\Exceptions\StoreFixEquipmentException;
use App\Http\Requests\FixNote\UpdateFixNote;
use App\Http\Requests\FixNote\StoreFixNote;
use App\Services\FixNoteService;
use Illuminate\Http\Request;

class FixNoteController extends Controller
{
    private $fixNoteRepo;
    private $fixNoteService;

    public function __construct(
        FixNoteService $fixNoteService
    ) {
        $this->fixNoteService = $fixNoteService;
        $this->fixNoteRepo = $fixNoteService->getFixNoteRepo();
    }

    public function index()
    {
        $notes = $this->fixNoteRepo->listFixNote();
        return view('fix_note.index', compact('notes'));
    }

    public function create()
    {
        return view('fix_note.create');
    }

    public function store(StoreFixNote $request)
    {
        try {
            $new_note = $this->fixNoteService->store($request);
            return redirect(route('fix_note.detail', ['id' => $new_note->id]))
                ->with('alert-success', trans('alert.create.success'));
        } catch (StoreFixEquipmentException $e) {
            return back()
                ->with('alert-fail', $e->getMessage());
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return back()
                ->with('alert-fail', trans('alert.create.fail'));
        }
    }

    public function detail($id)
    {
        $note = $this->fixNoteRepo->find_fix_note($id);
        $this->authorize('view_fix', $note);
        return view('fix_note.detail', compact('note'));
    }

    public function edit($id)
    {
        $note = $this->fixNoteRepo->find_fix_note($id);
        $this->authorize('update_fix', $note);
        return view('fix_note.edit', compact('note'));
    }

    public function update(UpdateFixNote $request, $id)
    {
        $note = $this->fixNoteRepo->find_fix_note($id);
        $this->authorize('update_fix', $note);
        try {
            $this->fixNoteService->update($request, $note);
        } catch (StoreFixEquipmentException $e) {
            return back()
                ->with('alert-fail', $e->getMessage());
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return back()
                ->with('alert-fail', trans('alert.update.fail'));
        }
        return redirect(route('fix_note.detail', ['id' => $note->id]))
            ->with('alert-success', trans('alert.update.success'));
    }

    public function delete($id)
    {
        $note = $this->fixNoteRepo->find_fix_note($id);
        $this->authorize('delete_fix', $note);
        $this->fixNoteService->delete($note);
        return back()->with('alert-success', trans('alert.delete.success'));
    }

    public function search(Request $request)
    {
        $notes = $this->fixNoteRepo->search2($request, $is_buy = false);
        return view('fix_note.index', compact('notes'));
    }
}
