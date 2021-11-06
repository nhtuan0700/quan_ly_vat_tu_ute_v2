<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportThietBi;
use App\Imports\ImportThietBi;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ThietBi\StoreThietBi;
use App\Http\Requests\ThietBi\UpdateThietBi;
use App\Repositories\ThietBi\ThietBiInterface;

class ThietBiController extends Controller
{
    protected $thietBiRepo;

    public function __construct(
        ThietBiInterface $thietBiInterface
    ) {
        $this->thietBiRepo = $thietBiInterface;
    }

    public function index()
    {
        $list_thietbi = $this->thietBiRepo->paginate();
        return view('thietbi.index', compact('list_thietbi'));
    }

    public function create()
    {
        $new_id = $this->thietBiRepo->getAutoId();
        return view('thietbi.create', compact('new_id'));
    }

    public function store(StoreThietBi $request)
    {
        $data = $request->only(['id', 'name', 'phong', 'ngay_mua', 'ngay_cap']);
        $new_data = $this->thietBiRepo->create($data);
        return redirect(route('thietbi.edit', ['id' => $new_data->id]))
            ->with('alert-success', trans('alert.create.success'));
    }

    public function edit($id)
    {
        $thietbi = $this->thietBiRepo->findOrFail($id);
        return view('thietbi.edit', compact('thietbi'));
    }

    public function update(UpdateThietBi $request, $id)
    {
        $data = $request->only(['name', 'phong', 'ngay_mua', 'ngay_cap']);
        $this->thietBiRepo->update($id, $data);
        return redirect(route('thietbi.edit', ['id' => $request->id]))
            ->with('alert-success', trans('alert.update.success'));
    }

    // public function delete($id)
    // {
    //     $this->thietBiRepo->delete($id);
    //     return back()->with('alert-success', trans('alert.delete.success'));
    // }

    public function search(Request $request)
    {
        $columns = $request->only(['id']);
        $list_thietbi = $this->thietBiRepo->search($columns, ['id']);
        return view('thietbi.index', compact('list_thietbi'));
    }

    public function export_excel()
    {
        return Excel::download(new ExportThietBi, 'thietbi.xlsx');
    }

    public function import_excel()
    {
        $list_thietbi = Excel::toCollection(new ImportThietBi, request()->file('file_excel'));
        $error = [];
        
        foreach ($list_thietbi[0] as $key => $value) {
            try {
                $thietbi = [
                    'id' => $value[0],
                    'name' => $value[1],
                    'phong' => $value[2],
                    'ngay_mua' => transformDateExcel($value[3]),
                    'ngay_cap' => transformDateExcel($value[4]),
                ];
                $this->thietBiRepo->create($thietbi);
            } catch (\Throwable $th) {
                $index = $key + 1;
                array_push($error, "Hàng thứ $index");
            }
        }
        if (!empty($error)) {
            $message = sprintf('Có %s hàng thất bại:\n%s', count($error), join('\n', $error));
            return redirect('thietbi.index')->with('alert-result', $message)->with('alert-success', 'Import Excel thành công!');
        }
        return redirect('thietbi.index')->with('alert-success', 'Import Excel thành công!');
    }
}
