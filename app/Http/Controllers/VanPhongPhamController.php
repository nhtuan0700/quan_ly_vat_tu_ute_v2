<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportVanPhongPham;
use App\Exports\ExportVanPhongPhamTemplate;
use App\Imports\ImportVanPhongPham;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\DanhMuc\DanhMucInterface;
use App\Http\Requests\VanPhongPham\StoreVanPhongPham;
use App\Http\Requests\VanPhongPham\UpdateVanPhongPham;
use App\Repositories\VanPhongPham\VanPhongPhamInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        return redirect(route('vanphongpham.index'))->with('alert-success', trans('alert.create.success'));
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

    public function export_excel()
    {
        return Excel::download(new ExportVanPhongPham, 'vanphongpham.xlsx');
    }

    public function download_template()
    {
        return Excel::download(new ExportVanPhongPhamTemplate, 'vanphongpham_template.xlsx');
    }

    public function import_excel()
    {
        $list_vanphongpham = Excel::toCollection(new ImportVanPhongPham, request()->file('file_excel'));
        $error = [];
        foreach ($list_vanphongpham[0] as $key => $value) {
            try {
                $danhmuc = $this->danhMucRepo->where('name', $value[3])->firstOrFail();
                $is_exist = $this->vanPhongPhamRepo->where('name', $value[0])->exists();
                if ($is_exist) {
                    throw new Exception();
                }
                $vanphongpham = [
                    'name' => $value[0],
                    'dvt' => $value[1],
                    'hanmuc_tb' => $value[2],
                    'id_danhmuc' => $danhmuc->id,
                ];
                $this->vanPhongPhamRepo->create($vanphongpham);
            } catch (\Throwable $th) {
                $index = $key + 1;
                array_push($error, "Hàng thứ $index");
            }
        }
        if (!empty($error)) {
            $message = sprintf('Có %s hàng thất bại:\n%s', count($error), join('\n', $error));
            return redirect(route('vanphongpham.index'))->with('alert-result', $message)->with('alert-success', 'Import Excel thành công!');
        }
        return redirect(route('vanphongpham.index'))->with('alert-success', 'Import Excel thành công!');
    }
}
