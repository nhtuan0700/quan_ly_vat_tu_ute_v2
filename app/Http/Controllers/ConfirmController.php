<?php

namespace App\Http\Controllers;

use App\Exceptions\UpdateDetailSuaException;
use Illuminate\Http\Request;
use App\Services\ConfirmService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ConfirmController extends Controller
{
    private $confirmServie;
    private $phieuRepo;
    private $dangKyRepo;

    public function __construct(
        ConfirmService $confirmService
    ) {
        $this->confirmServie = $confirmService;
        $this->phieuRepo = $confirmService->getPhieuRepo();
        $this->dangKyRepo = $confirmService->getDangKyRepo();
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
        if ($phieu->is_mua) {
            $list_dangky_donvi = $this->dangKyRepo->detailByDonVi($phieu->id_dotdk, $phieu->id_donvi, $phieu->id);
            if (!!$phieu->confirmed_at) {
                return view('confirm.detail_confirmed.mua', compact('phieu', 'list_dangky_donvi'));
            }
            return view('confirm.detail_unconfirm.mua', compact('phieu', 'list_dangky_donvi'));
        }
        if (!!$phieu->confirmed_at) {
            return view('confirm.detail_confirmed.sua', compact('phieu'));
        }
        return view('confirm.detail_unconfirm.sua', compact('phieu'));
    }

    public function confirm(Request $request, $id)
    {
        $phieu = $this->phieuRepo->find($id);
        $this->authorize('confirm', $phieu);
        try {
            $this->confirmServie->confirm($request, $phieu);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('alert-fail', 'Duyệt phiếu thất bại');
        }
        return redirect(route('confirm.detail', ['id' => $id]))
            ->with('alert-success', 'Duyệt phiếu thành công');
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
        $this->authorize('update_detail_sua', $phieu);
        try {
            $this->confirmServie->update_detail_sua($request, $id);
            return redirect(route('confirm.detail', ['id' => $id]))
                ->with('alert-success', 'Cập nhật phiếu thành công');
        } catch (UpdateDetailSuaException $e) {
            return back()->with('alert-fail', $e->getMessage());
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return back()->with('alert-fail', 'Cập nhật phiếu thất bại');
        }
    }
}
