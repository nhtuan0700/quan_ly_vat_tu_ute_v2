<?php

namespace App\Http\Controllers;

use App\Models\ThietBi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Repositories\ChiTietMua\ChiTietMuaInterface;
use App\Repositories\ChiTietSua\ChiTietSuaInterface;
use App\Repositories\PhieuDeNghi\PhieuDeNghiInterface;
use App\Repositories\DangKyVanPhongPham\DangKyVanPhongPhamInterface;
use App\Repositories\ThietBi\ThietBiInterface;
use Exception;

class ConfirmController extends Controller
{
    protected $phieuRepo;
    protected $dangKyVPPRepo;

    public function __construct(
        PhieuDeNghiInterface $phieuDeNghiInterface,
        DangKyVanPhongPhamInterface $dangKyVanPhongPhamInterface
    ) {
        $this->phieuRepo = $phieuDeNghiInterface;
        $this->dangKyVPPRepo = $dangKyVanPhongPhamInterface;
    }

    public function index(Request $request)
    {
        $limit = Config::get('constants.limit_page');
        $list_phieu = $this->phieuRepo->query()
            ->when($request->status, function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->when($request->id, function ($query) use ($request) {
                return $query->where('id', $request->id);
            })
            ->orderby('status', 'asc')
            ->orderby('created_at', 'asc')
            ->paginate($limit)->appends(request()->all());
        return view('confirm.index', compact('list_phieu'));
    }

    public function detail($id)
    {
        $phieu = $this->phieuRepo->find($id);
        if (!!$phieu->confirmed_at) {
            if ($phieu->is_mua) {
                $list_dangky_donvi = $this->dangKyVPPRepo->detailByDonVi($phieu->id_dotdk, $phieu->id_donvi, $phieu->id);
                return view('confirm.detail_confirmed.mua', compact('phieu', 'list_dangky_donvi'));
            }
            return view('confirm.detail_confirmed.sua', compact('phieu'));
        }
        if ($phieu->is_mua) {
            $list_dangky_donvi = $this->dangKyVPPRepo->detailByDonVi($phieu->id_dotdk, $phieu->id_donvi, $phieu->id);
            return view('confirm.detail_unconfirm.mua', compact('phieu', 'list_dangky_donvi'));
        }
        return view('confirm.detail_unconfirm.sua', compact('phieu'));
    }

    public function confirm(Request $request, $id)
    {
        $phieu = $this->phieuRepo->find($id);
        $this->authorize('confirm', $phieu);
        try {
            DB::beginTransaction();
            if ($phieu->is_mua) {
                $this->confirm_mua($request, $phieu);
            } else {
                $this->confirm_sua($phieu);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
            return back()->with('alert-fail', 'Duyệt phiếu thất bại');
        }
        DB::commit();
        return redirect(route('confirm.detail', ['id' => $id]))
            ->with('alert-success', 'Duyệt phiếu thành công');
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
        $this->phieuRepo->confirm($phieu->id);
        $detailMuaRepo = app(ChiTietMuaInterface::class);
        $detailMuaRepo->updateWhenConfirmed($phieu->id, $request->vanphongpham);
    }

    private function confirm_sua($phieu)
    {
        $this->phieuRepo->confirm($phieu->id);
        $phieu->thietbi()->update(['status' => ThietBi::FIXING]);
    }

    public function update_detail_sua(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'thietbi.*.cost' => 'nullable|numeric|min:1000',
        ]);
        if ($validator->fails()) {
            session()->flash('alert-fail', 'Chi phí tối thiếu 1,000 đ');
            throw new ValidationException($validator);
        }
        $phieu = $this->phieuRepo->findOrFail($id);
        $detailSuaRepo = app(ChiTietSuaInterface::class);
        $thietBiRepo = app(ThietBiInterface::class);
        try {
            DB::beginTransaction();
            foreach ($request->thietbi as $id_thietbi => $item) {
                throw_if(!!$item['status'] && is_null($item['cost']), new Exception());
                $detailSuaRepo->where('id_phieu', $id)->where('id_thietbi', $id_thietbi)->update([
                    'cost' => !!$item['status'] ? $item['cost'] : null
                ]);
                $thietBiRepo->findOrFail($id_thietbi)->update([
                    'status' => !!$item['status'] ? ThietBi::NORMAL : ThietBi::BROKEN
                ]);
            }
            DB::commit();
            return redirect(route('confirm.detail', ['id' => $id]))
                ->with('alert-success', 'Cập nhật phiếu thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()
                ->with('alert-fail', $th->getMessage());
        }
    }
}
