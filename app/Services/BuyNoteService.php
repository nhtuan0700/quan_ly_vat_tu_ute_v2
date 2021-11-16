<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\DetailBuy\DetailBuyInterface;
use App\Repositories\RequestNote\RequestNoteInterface;
use App\Repositories\Registration\RegistrationInterface;
use App\Repositories\PeriodRegistration\PeriodRegistrationInterface;
use Illuminate\Http\Request;

class BuyNoteService
{
    private $buyNoteRepo;
    private $registrationRepo;
    private $periodRepo;
    private $detailBuyRepo;

    public function __construct(
        RequestNoteInterface $requestNoteInterface,
        RegistrationInterface $registrationInterface,
        PeriodRegistrationInterface $periodRegistrationInterface,
        DetailBuyInterface $detailBuyInterface
    ) {
        $this->buyNoteRepo = $requestNoteInterface;
        $this->registrationRepo = $registrationInterface;
        $this->periodRepo = $periodRegistrationInterface;
        $this->detailBuyRepo = $detailBuyInterface;
    }

    public function getBuyNoteRepo()
    {
        return $this->buyNoteRepo;
    }
    public function getPeriodRepo()
    {
        return $this->periodRepo;
    }
    public function getRegistrationRepo()
    {
        return $this->registrationRepo;
    }

    public function store(Request $request, $id_period)
    {
        $data = [
            'id_creator' => auth()->id(),
            'id_department' => auth()->user()->id_department,
            'id_period' => $id_period,
            'description' => $request->description
        ];

        return DB::transaction(function () use ($data, $id_period) {
            $new_note = $this->buyNoteRepo->create_buy_note($data);
            $sum_stationeies = $this->registrationRepo->sumStationeryByDepartment(
                $id_period,
                auth()->user()->id_department
            );
            foreach ($sum_stationeies as $item) {
                $this->detailBuyRepo->create([
                    'id_note' => $new_note->id,
                    'id_stationery' => $item->id_stationery,
                    'qty' => $item->qty
                ]);
            }
            $this->registrationRepo->updateAfterCreated(
                $new_note->id_period,
                $new_note->id_department,
                $new_note->id
            );
            return $new_note;
        });
    }
}
