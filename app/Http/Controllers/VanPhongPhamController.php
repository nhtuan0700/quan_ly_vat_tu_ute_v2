<?php

namespace App\Http\Controllers;

use App\Http\Requests\VanPhongPham\StoreVanPhongPham;
use App\Http\Requests\VanPhongPham\UpdateVanPhongPham;
use App\Repositories\DanhMuc\DanhMucInterface;
use App\Repositories\VanPhongPham\VanPhongPhamInterface;
use Illuminate\Http\Request;

class VanPhongPhamController extends Controller
{
    protected $vanPhongPhamRepo;
    protected $danhMucRepo;

    public function __construct(
        VanPhongPhamInterface $vanPhongPhamInterface,
        DanhMucInterface $danhMucInterface
    ) {
        $this->vanPhongPhamRepo = $vanPhongPhamInterface;
        $this->danhMucRepo = $danhMucInterface;
    }

    public function index()
    {
        $list_vpp = $this->vanPhongPhamRepo->paginate();
        $list_danhmuc = $this->danhMucRepo->all();
        $rank = $list_vpp->firstItem();
        return view('vanphongpham.index', compact('list_vpp', 'rank', 'list_danhmuc'));
    }

    public function create()
    {
        $list_danhmuc = $this->danhMucRepo->all();
        return view('vanphongpham.create', compact('list_danhmuc'));
    }

    public function store(StoreVanPhongPham $request)
    {
        $data = $request->only(['name', 'dvt', 'hanmuc_tb', 'id_danhmuc']);

        $this->vanPhongPhamRepo->create($data);
        return back()->with('alert-success', trans('alert.create.success'));
    }

    public function edit($id)
    {
        $vpp = $this->vanPhongPhamRepo->findOrFail($id);
        $list_danhmuc = $this->danhMucRepo->all();
        return view('vanphongpham.edit', compact('vpp', 'list_danhmuc'));
    }

    public function update(UpdateVanPhongPham $request, $id)
    {
        $data = $request->only(['name', 'dvt', 'hanmuc_tb', 'id_danhmuc']);
        $this->vanPhongPhamRepo->update($id, $data);
        return back()->with('alert-success', trans('alert.update.success'));
    }

    public function delete($id)
    {
        $this->vanPhongPhamRepo->delete($id);
        return back()->with('alert-success', trans('alert.delete.success'));
    }

    public function search(Request $request)
    {
        $columns = $request->only(['name']);
        $columns['id_danhmuc'] = $request->danhmuc;
        $list_vpp = $this->vanPhongPhamRepo->search($columns, ['id_danhmuc']);
        $rank = $list_vpp->firstItem();
        $list_danhmuc = $this->danhMucRepo->all();
        return view('vanphongpham.index', compact('list_vpp', 'rank', 'list_danhmuc'));
    }
}
