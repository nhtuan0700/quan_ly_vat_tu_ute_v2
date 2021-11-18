<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportStationery;
use Maatwebsite\Excel\Facades\Excel;
use App\Exceptions\ImportExcelException;
use App\Exports\ExportStationeryTemplate;
use App\Repositories\Category\CategoryInterface;
use App\Http\Requests\Stationery\StoreStationery;
use App\Http\Requests\Stationery\UpdateStationery;
use App\Imports\ImportStationery;
use App\Repositories\Stationery\StationeryInterface;

class StationeryController extends Controller
{
    private $stationeryRepo;
    private $categoryRepo;

    public function __construct(
        StationeryInterface $stationeryInterface,
        CategoryInterface $categoryInterface
    ) {
        $this->stationeryRepo = $stationeryInterface;
        $this->categoryRepo = $categoryInterface;
    }

    public function index()
    {
        $stationeries = $this->stationeryRepo->paginate();
        $categories = $this->categoryRepo->all();
        $rank = $stationeries->firstItem();
        return view('stationery.index', compact('stationeries', 'rank', 'categories'));
    }

    public function create()
    {
        $categories = $this->categoryRepo->all();
        return view('stationery.create', compact('categories'));
    }

    public function store(StoreStationery $request)
    {
        $data = $request->validated();
        $new_stationery = $this->stationeryRepo->create($data);
        return redirect(route('stationery.edit', ['id' => $new_stationery->id]))
            ->with('alert-success', trans('alert.create.success'));
    }

    public function edit($id)
    {
        $stationery = $this->stationeryRepo->findOrFail($id);
        $categories = $this->categoryRepo->all();
        return view('stationery.edit', compact('stationery', 'categories'));
    }

    public function update(UpdateStationery $request, $id)
    {
        $data = $request->validated();
        $this->stationeryRepo->update($id, $data);
        return back()->with('alert-success', trans('alert.update.success'));
    }

    public function delete($id)
    {
        $this->stationeryRepo->delete($id);
        return back()->with('alert-success', trans('alert.delete.success'));
    }

    public function search(Request $request)
    {
        $columns = $request->only(['name', 'id_category']);
        $stationeries = $this->stationeryRepo->search($columns, ['id_category']);
        $rank = $stationeries->firstItem();
        $categories = $this->categoryRepo->all();
        return view('stationery.index', compact('stationeries', 'rank', 'categories'));
    }

    public function export_excel()
    {
        return Excel::download(new ExportStationery, 'vanphongpham.xlsx');
    }

    public function download_template()
    {
        return Excel::download(new ExportStationeryTemplate, 'vanphongpham_template.xlsx');
    }

    public function import_excel()
    {
        $stationeries = Excel::toCollection(new ImportStationery, request()->file('file_excel'));
        $error = [];
        foreach ($stationeries[0] as $key => $item) {
            if ($item->filter()->isEmpty()) {
                break;
            };
            try {
                $category = $this->categoryRepo->where('name', $item[3])->firstOrFail();
                $is_exist = $this->stationeryRepo->where('name', $item[0])->exists();
                throw_if($is_exist, new ImportExcelException());
                $stationery = [
                    'name' => $item[0],
                    'unit' => $item[1],
                    'limit_avg' => $item[2],
                    'id_category' => $category->id,
                ];
                $this->stationeryRepo->create($stationery);
            } catch (ImportExcelException $e) {
                $index = $key + 1;
                array_push($error, "Hàng thứ $index");
            }
        }
        if (!empty($error)) {
            $message = sprintf('Có %s hàng thất bại:\n%s', count($error), join('\n', $error));
            return redirect(route('stationery.index'))->with('alert-result', $message)
                ->with('alert-success', 'Import Excel thành công!');
        }
        return redirect(route('stationery.index'))->with('alert-success', 'Import Excel thành công!');
    }
}
