<?php

namespace App\Http\Controllers;

use App\Repositories\ChiTietMua\ChiTietMuaInterface;
use App\Repositories\DangKyVanPhongPham\DangKyVanPhongPhamInterface;
use App\Repositories\DotDangKy\DotDangKyInterface;
use App\Repositories\PhieuDeNghi\PhieuDeNghiInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhieuMuaController extends Controller
{
    protected $phieuMuaRepo;
    protected $dangKyVPPRepo;
    protected $dotDangKyRepo;

    public function __construct(
        PhieuDeNghiInterface $phieuDeNghiInterface,
        DangKyVanPhongPhamInterface $dangKyVanPhongPhamInterface,
        DotDangKyInterface $dotDangKyInterface
    ) {
        $this->phieuMuaRepo = $phieuDeNghiInterface;
        $this->dangKyVPPRepo = $dangKyVanPhongPhamInterface;
        $this->dotDangKyRepo = $dotDangKyInterface;
    }

    public function index()
    {
        $list_phieumua = $this->phieuMuaRepo->listPhieuMuaDonVi();
        // dd($list_phieumua);
        return view('phieumua.index', compact('list_phieumua'));
    }

    public function list_dot_dang_ky()
    {
        $list_dotdangky = $this->dotDangKyRepo->list();
        return view('phieumua.list_dot_dang_ky', compact('list_dotdangky'));
    }

    public function create($id_dotdk)
    {
        $dot_dk = $this->dotDangKyRepo->findOrFail($id_dotdk);
        $start_time = $dot_dk->getRawOriginal('start_at');
        $end_time = $dot_dk->getRawOriginal('end_at');

        // Kiểm tra đợt đăng ký sắp | đang diễn ra
        if (now() <= $end_time) {
            $message = 'Vui lòng chờ đợt đăng ký kết thúc mới được tổng hợp đăng ký';
            return view('phieumua.create_fail', compact('message'));
        }
        // Kiểm tra đợt đăng ký đã có phiếu chưa
        if (!!$dot_dk->getPhieuMuaDonVi()) {
            return redirect(route('phieumua.detail', ['id' => $dot_dk->getPhieuMuaDonVi()->id]));
        };
        $id_donvi = auth()->user()->id_donvi;
        $vanphongpham_tonghop = $this->dangKyVPPRepo->tongHopDangKyDonVi($id_dotdk, $id_donvi);
        $list_dangky_donvi = $this->dangKyVPPRepo->listByDonVi($id_dotdk, $id_donvi);
        return view('phieumua.create', compact('vanphongpham_tonghop', 'list_dangky_donvi', 'id_dotdk'));
    }

    public function store(Request $request, $id_dotdk)
    {
        $dot_dk = $this->dotDangKyRepo->findOrFail($id_dotdk);
        $start_time = $dot_dk->getRawOriginal('start_at');
        $end_time = $dot_dk->getRawOriginal('end_at');

        if (now() <= $end_time || !!$dot_dk->phieumua) {
            return redirect(route('phieumua.create', ['id_dotdk' => $id_dotdk]));
        }

        try {
            DB::beginTransaction();
            $data = [
                'id_creator' => auth()->id(),
                'id_donvi' => auth()->user()->id_donvi,
                'id_dotdk' => $id_dotdk,
                'note' => $request->note
            ];
            $new_phieu = $this->phieuMuaRepo->create_mua($data);
            $vanphongpham_tonghop = $this->dangKyVPPRepo->tongHopDangKyDonVi($id_dotdk, auth()->user()->id_donvi);
            $chiTietMuaRepo = app(ChiTietMuaInterface::class);
            foreach ($vanphongpham_tonghop as $item) {
                $chiTietMuaRepo->create([
                    'id_phieu' => $new_phieu->id,
                    'id_vanphongpham' => $item->id_vanphongpham,
                    'qty' => $item->qty
                ]);
            }
            $this->dangKyVPPRepo->updateStatusDonVi($new_phieu->id_donvi);
            DB::commit();
            return redirect(route('phieumua.detail', ['id' => $new_phieu->id]))
                ->with('alert-success', trans('alert.create.success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return 'Lỗi';
        }
    }

    public function detail($id)
    {
        $phieu = $this->phieuMuaRepo->find_mua($id);
        $this->authorize('view_mua', $phieu);
        $list_dangky_donvi = $this->dangKyVPPRepo->listByDonVi($phieu->id_dotdk, $phieu->id_donvi);
        return view('phieumua.detail', compact('phieu', 'list_dangky_donvi'));
    }

    public function search(Request $request)
    {
        $list_phieumua = $this->phieuMuaRepo->search2($request, true);
        return view('phieuMua.index', compact('list_phieumua'));
    }
}
