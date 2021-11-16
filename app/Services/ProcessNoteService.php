<?php

namespace App\Services;

use App\Exceptions\UpdateDetailFixException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Repositories\DetailBuy\DetailBuyInterface;
use App\Repositories\Equipment\EquipmentInterface;
use App\Repositories\RequestNote\RequestNoteInterface;
use App\Repositories\Registration\RegistrationInterface;
use App\Http\Requests\FixNote\UpdateDetailFixRequest;
use App\Repositories\DetailFix\DetailFixInterface;

class ProcessNoteService
{
    private $noteRepo;
    private $registrationRepo;
    private $equipmentRepo;

    public function __construct(
        RequestNoteInterface $requestNoteInterface,
        RegistrationInterface $registrationInterface,
        EquipmentInterface $equipmentInterface
    ) {
        $this->noteRepo = $requestNoteInterface;
        $this->registrationRepo = $registrationInterface;
        $this->equipmentRepo = $equipmentInterface;
    }

    public function getNoteRepo()
    {
        return $this->noteRepo;
    }
    public function getRegistrationRepo()
    {
        return $this->registrationRepo;
    }

    public function confirm($request, $note)
    {
        if ($note->is_buy) {
            $this->confirm_buy_note($request, $note);
        } else {
            $this->confirm_fix_note($note);
        }
    }

    private function confirm_buy_note(Request $request, $note)
    {
        $validator = Validator::make($request->all(), [
            'stationeries.*.cost' => 'required|numeric|min:1000',
        ]);
        if ($validator->fails()) {
            session()->flash('alert-fail', 'Trường giá không được để trống!<br/> Giá tối thiếu 1,000 đ');
            throw new ValidationException($validator);
        }
        DB::transaction(function () use ($note, $request) {
            $this->noteRepo->process($note->id, true);
            $detailBuyRepo = app(DetailBuyInterface::class);
            $detailBuyRepo->updateWhenConfirmed($note->id, $request->stationeries);
        });
    }

    private function confirm_fix_note($note)
    {
        DB::transaction(function () use ($note) {
            $this->noteRepo->process($note->id, true);
            $note->equipments()->update(['status' => $this->equipmentRepo::FIXING]);
        });
    }

    public function reject($note)
    {
        DB::transaction(function() use ($note) {
            $this->noteRepo->process($note->id, false);
        });
    }

    public function update_detail_fix(UpdateDetailFixRequest $request, $id)
    {
        $detailSuaRepo = app(DetailFixInterface::class);
        DB::transaction(function () use ($request, $id, $detailSuaRepo) {
            foreach ($request->equipments as $id_equipment => $item) {
                throw_if(!!$item['status'] && is_null($item['cost']), new UpdateDetailFixException());
                $detailSuaRepo->where('id_note', $id)->where('id_equipment', $id_equipment)->update([
                    'cost' => !!$item['status'] ? $item['cost'] : null
                ]);
                $this->equipmentRepo->findOrFail($id_equipment)->update([
                    'status' => !!$item['status'] ? $this->equipmentRepo::NORMAL : $this->equipmentRepo::BROKEN
                ]);
            }
        });
    }
}
