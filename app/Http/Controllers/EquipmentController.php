<?php

namespace App\Http\Controllers;

use App\Exports\ExportEquipment;
use App\Exports\ExportEquipmentTemplate;
use Illuminate\Http\Request;
use App\Http\Requests\Equipment\StoreEquipment;
use App\Http\Requests\Equipment\UpdateEquipment;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportEquipment;
use App\Repositories\Equipment\EquipmentInterface;

class EquipmentController extends Controller
{
    private $equipmentRepo;

    public function __construct(
        EquipmentInterface $equipmentInterface
    ) {
        $this->equipmentRepo = $equipmentInterface;
    }

    public function index()
    {
        $equipments = $this->equipmentRepo->paginate();
        return view('equipment.index', compact('equipments'));
    }

    public function create()
    {
        $new_id = $this->equipmentRepo->getAutoId();
        return view('equipment.create', compact('new_id'));
    }

    public function store(StoreEquipment $request)
    {
        $data = $request->validated();
        $new_equipment = $this->equipmentRepo->create($data);
        return redirect(route('equipment.edit', ['id' => $new_equipment->id]))
            ->with('alert-success', trans('alert.create.success'));
    }

    public function edit($id)
    {
        $equipment = $this->equipmentRepo->findOrFail($id);
        return view('equipment.edit', compact('equipment'));
    }

    public function update(UpdateEquipment $request, $id)
    {
        $data = $request->validated();
        $this->equipmentRepo->update($id, $data);
        return redirect(route('equipment.edit', ['id' => $request->id]))
            ->with('alert-success', trans('alert.update.success'));
    }

    public function search(Request $request)
    {
        $columns = $request->only(['id']);
        $equipments = $this->equipmentRepo->search($columns, ['id']);
        return view('equipment.index', compact('equipments'));
    }

    public function list_ajax(Request $request)
    {
        $equipments = $this->equipmentRepo->query()
            ->when(!is_null($request->id_exists), function ($query) use ($request) {
                return $query->whereNotIn('id', $request->id_exists);
            })
            ->where('id', $request->id)
            ->get();
        return response()->json($equipments);
    }

    public function export_excel()
    {
        return Excel::download(new ExportEquipment, 'thietbi.xlsx');
    }

    public function download_template()
    {
        return Excel::download(new ExportEquipmentTemplate, 'thietbi_template.xlsx');
    }

    public function import_excel()
    {
        $equipments = Excel::toCollection(new ImportEquipment, request()->file('file_excel'));
        $error = [];
        foreach ($equipments[0] as $key => $item) {
            if ($item->filter()->isEmpty()) {
                break;
            };
            try {
                $equipment = [
                    'id' => $item[0],
                    'name' => $item[1],
                    'room' => $item[2],
                    'date_buy' => transformDateExcel($item[3]),
                    'date_grant' => transformDateExcel($item[4]),
                ];
                $this->equipmentRepo->create($equipment);
            } catch (\Throwable $th) {
                $index = $key + 1;
                array_push($error, "Hàng thứ $index");
            }
        }
        if (!empty($error)) {
            $message = sprintf('Có %s hàng thất bại:\n%s', count($error), join('\n', $error));
            return redirect(route('equipment.index'))->with('alert-result', $message)->with('alert-success', 'Import Excel thành công!');
        }
        return redirect(route('equipment.index'))->with('alert-success', 'Import Excel thành công!');
    }
}
