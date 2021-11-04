<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThietBi\StoreThietBi;
use App\Http\Requests\ThietBi\UpdateThietBi;
use App\Repositories\ThietBi\ThietBiInterface;
use Illuminate\Http\Request;

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
        return view('thietbi.create');
    }

    public function store(StoreThietBi $request)
    {
        $data = $request->only(['id', 'name', 'phong']);
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
        $data = $request->only(['id', 'name', 'phong']);
        $this->thietBiRepo->update($id, $data);
        return redirect(route('thietbi.edit', ['id' => $request->id]))
            ->with('alert-success', trans('alert.update.success'));
    }

    public function delete($id)
    {
        $this->thietBiRepo->delete($id);
        return back()->with('alert-success', trans('alert.delete.success'));
    }

    public function search(Request $request)
    {
        $columns = $request->only(['id']);
        $list_thietbi = $this->thietBiRepo->search($columns, ['id']);
        return view('thietbi.index', compact('list_thietbi'));
    }
}
