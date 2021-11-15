<?php

namespace App\Services;

use App\Exceptions\UpdateDetailSuaException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ThietBi\ThietBiInterface;
use Illuminate\Validation\ValidationException;
use App\Repositories\ChiTietSua\ChiTietSuaInterface;
use App\Repositories\PhieuDeNghi\PhieuDeNghiInterface;
use App\Repositories\DangKyVanPhongPham\DangKyVanPhongPhamInterface;

class ConfirmService
{
    private $phieuRepo;
    private $dangKyRepo;
    private $thietBiRepo;

    public function __construct(
        PhieuDeNghiInterface $phieuDeNghiInterface,
        DangKyVanPhongPhamInterface $dangKyVanPhongPhamInterface,
        ThietBiInterface $thietBiInterface
    ) {
        $this->phieuRepo = $phieuDeNghiInterface;
        $this->dangKyRepo = $dangKyVanPhongPhamInterface;
        $this->thietBiRepo = $thietBiInterface;
    }

    public function getPhieuRepo()
    {
        return $this->phieuRepo;
    }
    public function getDangKyRepo()
    {
        return $this->dangKyRepo;
    }

    public function confirm($request, $phieu)
    {
        if ($phieu->is_mua) {
            $this->confirm_mua($request, $phieu);
        } else {
            $this->confirm_sua($phieu);
        }
    }

    private function confirm_mua(Request $request, $phieu)
    {
        $validator = Validator::make($request->all(), [
            'vanphongpham.*.cost' => 'required|numeric|min:1000',
        ]);
        if ($validator->fails()) {
            session()->flash('alert-fail', 'Trường giá không được để trống!<br/> Giá tối thiếu 1,000 đ');
            throw new ValidationException($validator);
        }
        DB::transaction(function() use ($phieu, $request) {
            $this->phieuRepo->confirm($phieu->id);
            $detailMuaRepo = app(ChiTietMuaInterface::class);
            $detailMuaRepo->updateWhenConfirmed($phieu->id, $request->vanphongpham);
        });
    }

    private function confirm_sua($phieu)
    {
        DB::transaction(function() use ($phieu) {
            $this->phieuRepo->confirm($phieu->id);
            $phieu->thiet_bi()->update(['status' => $this->thietBiRepo::FIXING]);
        });
    }

    public function update_detail_sua(Request $request, $id)
    {
        $detailSuaRepo = app(ChiTietSuaInterface::class);
        DB::transaction(function() use ($request, $id, $detailSuaRepo) {
            foreach ($request->thietbi as $id_thietbi => $item) {
                throw_if(!!$item['status'] && is_null($item['cost']), new UpdateDetailSuaException());
                $detailSuaRepo->where('id_phieu', $id)->where('id_thietbi', $id_thietbi)->update([
                    'cost' => !!$item['status'] ? $item['cost'] : null
                ]);
                $this->thietBiRepo->findOrFail($id_thietbi)->update([
                    'status' => !!$item['status'] ? $this->thietBiRepo::NORMAL : $this->thietBiRepo::BROKEN
                ]);
            }
        });
    }
}
