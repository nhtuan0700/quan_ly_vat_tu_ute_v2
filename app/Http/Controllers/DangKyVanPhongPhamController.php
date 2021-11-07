<?php

namespace App\Http\Controllers;

use App\Exceptions\OverHanMucException;
use App\Http\Requests\DangKyVPP\SaveDangKyVPP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\HanMuc\HanMucInterface;
use App\Repositories\DangKyVanPhongPham\DangKyVanPhongPhamInterface;
use App\Repositories\DotDangKy\DotDangKyInterface;

class DangKyVanPhongPhamController extends Controller
{
    protected $hanMucRepo;
    protected $dotDangKyRepo;
    protected $dangKyVPPRepo;

    public function __construct(
        HanMucInterface $hanMucInterface,
        DotDangKyInterface $dotDangKyInterface,
        DangKyVanPhongPhamInterface $dangKyVanPhongPhamInterface
    ) {
        $this->hanMucRepo = $hanMucInterface;
        $this->dotDangKyRepo = $dotDangKyInterface;
        $this->dangKyVPPRepo = $dangKyVanPhongPhamInterface;
    }

    public function index()
    {
        $dot_dk = $this->dotDangKyRepo->getDotDangKyNow();
        if (!$dot_dk) {
            return view('dangky_vpp.not_found');
        }
        $list_hanmuc = $this->hanMucRepo->listHanMucByUser(auth()->id());
        $list_dangky = $this->dangKyVPPRepo->listDangKy(auth()->id(), $dot_dk->id);
        return view('dangky_vpp.index', compact('list_hanmuc', 'dot_dk', 'list_dangky'));
    }

    public function save(SaveDangKyVPP $request)
    {
        $id_dotdk = $this->dotDangKyRepo->getDotDangKyNow()->id;
        $list_dangky = $this->dangKyVPPRepo->listDangKy(auth()->id(), $id_dotdk);
        DB::beginTransaction();
        try {
            // Reset hạn mức đã dăng ký ban đâu, sau đó xóa các đăng ký cũ
            foreach ($list_dangky as $item) {
                $hanMuc = $this->hanMucRepo->findItem(auth()->id(), $item->id);
                $hanMuc->decrement('qty_used', $item->qty);
                $this->dangKyVPPRepo->findItem(auth()->id(), $item->id, $id_dotdk)->delete();
            }
            // Thêm lại các đăng ký
            if ($request->vanphongpham) {
                foreach ($request->vanphongpham as $id_vanphongpham => $qty) {
                    $hanMuc = $this->hanMucRepo->findItem(auth()->id(), $id_vanphongpham);
                    if (($hanMuc->first()->qty_remain) < $qty) {
                        throw new OverHanMucException();
                    };
                    $this->dangKyVPPRepo->create([
                        'id_user' => auth()->id(),
                        'id_vanphongpham' => $id_vanphongpham,
                        'id_dotdk' => $id_dotdk,
                        'qty' => $qty
                    ]);
                    $hanMuc->update(['qty_used' => $hanMuc->first()->qty_used + $qty]);
                }
            }
            DB::commit();
            return back()->with('alert-success', 'Đăng ký thành công');
        } catch (OverHanMucException $e) {
            DB::rollBack();
            return back()->with('alert-fail', 'Số lượng vượt quá hạn mức');
        }
    }
}
