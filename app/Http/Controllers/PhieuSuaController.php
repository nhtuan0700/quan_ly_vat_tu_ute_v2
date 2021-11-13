<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhieuSua\StorePhieuSua;
use App\Http\Requests\PhieuSua\UpdatePhieuSua;
use App\Repositories\ChiTietSua\ChiTietSuaInterface;
use App\Repositories\PhieuDeNghi\PhieuDeNghiInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhieuSuaController extends Controller
{
    protected $phieuSuaRepo;
    protected $chiTietSuaRepo;

    public function __construct(
        PhieuDeNghiInterface $phieuDeNghiInterface,
        ChiTietSuaInterface $chiTietSuaInterface
    ) {
        $this->phieuSuaRepo = $phieuDeNghiInterface;
        $this->chiTietSuaRepo = $chiTietSuaInterface;
    }

    public function index()
    {
        $list_phieusua = $this->phieuSuaRepo->listPhieuSua();
        return view('phieusua.index', compact('list_phieusua'));
    }

    public function create()
    {
        return view('phieusua.create');
    }

    public function store(StorePhieuSua $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'id_creator' => auth()->id(),
                'id_donvi' => auth()->user()->id_donvi,
                'note' => $request->note
            ];
            $new_phieu = $this->phieuSuaRepo->create_sua($data);
            if ($request->thietbi) {
                foreach ($request->thietbi as $key => $value) {
                    $this->chiTietSuaRepo->create([
                        'id_phieu' => $new_phieu->id,
                        'id_thietbi' => $key,
                        'reason' => $value
                    ]);
                }
            }
            DB::commit();
            return redirect(route('phieusua.detail', ['id' => $new_phieu->id]))
                ->with('alert-success', trans('alert.create.success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }

    public function detail($id)
    {
        $phieu = $this->phieuSuaRepo->find_sua($id);
        $this->authorize('view_sua', $phieu);
        return view('phieusua.detail', compact('phieu'));
    }

    public function edit($id)
    {
        $phieu = $this->phieuSuaRepo->find_sua($id);
        $this->authorize('view_sua', $phieu);
        return view('phieusua.edit', compact('phieu'));
    }

    public function update(UpdatePhieuSua $request, $id)
    {
        $phieu = $this->phieuSuaRepo->find_sua($id);
        $this->authorize('update_sua', $phieu);
        $phieu->update(['note' => $request->note]);
        if ($request->thietbi) {
            $phieu->detail_sua()->delete();
            foreach ($request->thietbi as $key => $value) {
                $this->chiTietSuaRepo->create([
                    'id_phieu' => $phieu->id,
                    'id_thietbi' => $key,
                    'reason' => $value
                ]);
            }
        }
        return redirect(route('phieusua.detail', ['id' => $phieu->id]))
            ->with('alert-success', trans('alert.update.success'));
    }

    public function delete($id)
    {
        $phieu = $this->phieuSuaRepo->find_sua($id);
        $this->authorize('update_sua', $phieu);
        $phieu->delete();
        return back()->with('alert-success', trans('alert.delete.success'));
    }

    public function search(Request $request)
    {
        $list_phieusua = $this->phieuSuaRepo->search2($request, false);
        return view('phieusua.index', compact('list_phieusua'));
    }
}
