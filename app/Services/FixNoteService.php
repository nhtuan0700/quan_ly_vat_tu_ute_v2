<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\FixNote\StoreFixNote;
use App\Http\Requests\FixNote\UpdateFixNote;
use App\Repositories\DetailFix\DetailFixInterface;
use App\Repositories\RequestNote\RequestNoteInterface;

class FixNoteService
{
    private $fixNoteRepo;
    private $detailFixRepo;

    public function __construct(
        RequestNoteInterface $phieuDeNghiInterface,
        DetailFixInterface $detailFixInterface
    ) {
        $this->fixNoteRepo = $phieuDeNghiInterface;
        $this->detailFixRepo = $detailFixInterface;
    }

    public function getFixNoteRepo()
    {
        return $this->fixNoteRepo;
    }

    public function store(StoreFixNote $request)
    {
        return DB::transaction(function () use ($request) {
            $data = [
                'id_creator' => auth()->id(),
                'id_department' => auth()->user()->id_department,
                'description' => $request->description
            ];
            $new_note = $this->fixNoteRepo->create_fix_note($data);
            if ($request->equipments) {
                foreach ($request->equipments as $id_equipment => $reason) {
                    $this->detailFixRepo->create([
                        'id_note' => $new_note->id,
                        'id_equipment' => $id_equipment,
                        'reason' => $reason
                    ]);
                }
            }
            return $new_note;
        });
    }

    public function update(UpdateFixNote $request, $note)
    {
        DB::transaction(function () use ($request, $note) {
            $this->fixNoteRepo->find($note->id)->update(['description' => $request->description]);
            if ($request->equipments) {
                $note->detail_fix()->delete();
                foreach ($request->equipments as $id_equipment => $reason) {
                    $this->detailFixRepo->create([
                        'id_note' => $note->id,
                        'id_equipment' => $id_equipment,
                        'reason' => $reason
                    ]);
                }
            }
        });
    }
}
