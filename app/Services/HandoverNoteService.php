<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exceptions\HandoverListSuppliesException;
use App\Models\User;
use App\Notifications\CompleteRequestNoteNotification;
use App\Notifications\HandoverNoteNotification;
use App\Repositories\DetailBuy\DetailBuyInterface;
use App\Repositories\DetailFix\DetailFixInterface;
use App\Repositories\RequestNote\RequestNoteInterface;
use App\Repositories\HandoverNote\HandoverNoteInterface;
use App\Repositories\DetailHandoverBuy\DetailHandoverBuyInterface;
use App\Repositories\DetailHandoverFix\DetailHandoverFixInterface;
use Illuminate\Support\Facades\Notification;

class HandoverNoteService
{
    private $handoverNoteRepo;
    private $requestNoteRepo;
    private $detailHandoverBuyRepo;
    private $detailHandoverFixRepo;

    public function __construct(
        HandoverNoteInterface $handoverNoteInterface,
        RequestNoteInterface $requestNoteInterface,
        DetailHandoverBuyInterface $detailHandoverBuyInterface,
        DetailHandoverFixInterface $detailHandoverFixInterface
    ) {
        $this->handoverNoteRepo = $handoverNoteInterface;
        $this->requestNoteRepo = $requestNoteInterface;
        $this->detailHandoverBuyRepo = $detailHandoverBuyInterface;
        $this->detailHandoverFixRepo = $detailHandoverFixInterface;
    }

    public function getHandoverNoteRepo()
    {
        return $this->handoverNoteRepo;
    }
    public function getRequestNoteRepo()
    {
        return $this->requestNoteRepo;
    }

    public function store($request_note, Request $request)
    {
        if ($request_note->is_buy) {
            $stationeries = array_filter($request->stationeries ?? [], function ($qty) {
                return intval($qty) > 0;
            });
            throw_if(empty($stationeries), new HandoverListSuppliesException());
            $new_note = $this->store_handover_note_buy($request_note, $stationeries);
        } else {
            $equipments = array_filter($request->equipments ?? [], function ($is_handover) {
                return !!$is_handover;
            });
            throw_if(empty($equipments), new HandoverListSuppliesException());
            $new_note = $this->store_handover_note_fix($request_note, $equipments);
        }
        Notification::send(User::find($request_note->id_creator), new HandoverNoteNotification($new_note));
        return $new_note;
    }

    public function update($handover_note, Request $request)
    {
        if ($handover_note->request_note->is_buy) {
            $stationeries = array_filter($request->stationeries, function ($qty) {
                return intval($qty) > 0;
            });
            throw_if(empty($stationeries), new HandoverListSuppliesException());
            DB::transaction(function () use ($stationeries, $handover_note) {
                $handover_note->detail_handover_buy()->delete();
                $this->detailHandoverBuyRepo->create($handover_note->id, $handover_note->request_note->id, $stationeries);
            });
        } else {
            $equipments = array_filter($request->equipments ?? [], function ($is_handover) {
                return !!$is_handover;
            });
            throw_if(empty($equipments), new HandoverListSuppliesException());
            DB::transaction(function () use ($equipments, $handover_note) {
                $handover_note->detail_handover_fix()->delete();
                $this->detailHandoverFixRepo->create($handover_note->id, $handover_note->request_note->id, $equipments);
            });
        }
    }

    public function confirm($handover_note)
    {
        $request_note = $handover_note->request_note;
        DB::transaction(function () use ($handover_note, $request_note) {
            $handover_note->confirmed_at = now();
            $handover_note->save();
            if ($request_note->is_buy) {
                $detailBuyRepo = app(DetailBuyInterface::class);
                $detailBuyRepo->updateQtyHandovered($request_note->id, $handover_note->detail_handover_buy);
                $check_enough_handover = !$request_note->detail_buy()->whereRaw('qty > qty_handovered')->exists();
                if ($check_enough_handover) {
                    $this->requestNoteRepo->complete($request_note->id);
                    Notification::send(User::find($request_note->id_creator), new CompleteRequestNoteNotification($request_note));
                }
            } else {
                $detailFixRepo = app(DetailFixInterface::class);
                $detailFixRepo->updateHandovered($request_note->id, $handover_note->detail_handover_fix);
                $check_enough_handover = !$request_note->detail_fix()->where('is_handovered', false)->exists();
                if ($check_enough_handover) {
                    $this->requestNoteRepo->complete($request_note->id);
                    Notification::send(User::find($request_note->id_creator), new CompleteRequestNoteNotification($request_note));
                }
            }
        });
    }

    private function store_handover_note_buy($request_note, $stationeries)
    {
        return DB::transaction(function () use ($stationeries, $request_note) {
            $note_info = [
                'id_request_note' => $request_note->id,
                'id_creator' => auth()->id()
            ];
            $new_note = $this->handoverNoteRepo->create($note_info);
            if ($request_note->is_buy) {
                $this->detailHandoverBuyRepo->create($new_note->id, $request_note->id, $stationeries);
            }
            return $new_note;
        });
    }

    private function store_handover_note_fix($request_note, $equipments)
    {
        return DB::transaction(function () use ($equipments, $request_note) {
            $note_info = [
                'id_request_note' => $request_note->id,
                'id_creator' => auth()->id()
            ];
            $new_note = $this->handoverNoteRepo->create($note_info);
            $this->detailHandoverFixRepo->create($new_note->id, $request_note->id, $equipments);
            return $new_note;
        });
    }
}
