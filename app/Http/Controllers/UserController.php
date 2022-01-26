<?php

namespace App\Http\Controllers;

use App\Exceptions\ImportExcelException;
use App\Exports\ExportUser;
use App\Imports\ImportUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\User\StoreUser;
use App\Http\Requests\User\UpdateUser;
use App\Repositories\Role\RoleInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\User\ResetPassword;
use App\Repositories\Department\DepartmentInterface;
use App\Repositories\LimitStationery\LimitStationeryInterface;
use App\Repositories\Position\PositionInterface;

class UserController extends Controller
{
    private $userRepo;
    private $roleRepo;
    private $positionRepo;
    private $departmentRepo;
    private $limitRepo;

    public function __construct(
        UserInterface $userInterface,
        RoleInterface $roleInterface,
        DepartmentInterface $departmentInterface,
        PositionInterface $positionInterface,
        LimitStationeryInterface $limitStationeryInterface
    ) {
        $this->userRepo = $userInterface;
        $this->roleRepo = $roleInterface;
        $this->positionRepo = $positionInterface;
        $this->departmentRepo = $departmentInterface;
        $this->limitRepo = $limitStationeryInterface;
    }

    public function index()
    {
        $users = $this->userRepo->paginate();
        $departments = $this->departmentRepo->all();
        $roles = $this->roleRepo->all();
        return view('user.index', compact('users', 'roles', 'departments'));
    }

    public function create()
    {
        $roles = $this->roleRepo->all();
        $departments = $this->departmentRepo->all();
        $positions = $this->positionRepo->all();
        return view('user.create', compact('roles', 'departments', 'positions'));
    }

    public function store(StoreUser $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $new_user = $this->userRepo->create($data);
        return redirect(route('user.edit', ['id' => $new_user->id]))
            ->with('alert-success', trans('alert.create.success'));
    }

    public function edit($id)
    {
        $user = $this->userRepo->findOrFail($id);
        $roles = $this->roleRepo->all();
        $departments = $this->departmentRepo->all();
        $positions = $this->positionRepo->all();
        $limit_stationeries = $this->limitRepo->listByUser($id);
        $limit_updating = $limit_stationeries->contains(function ($item, $key) {
            return !is_null($item->qty_update) && $item->qty_update > 0;
        });
        return view('user.edit', compact(
            'roles',
            'user',
            'departments',
            'limit_stationeries',
            'positions',
            'limit_updating'
        ));
    }

    public function update(UpdateUser $request, $id)
    {
        $data = $request->validated();
        $data['id_role'] = $id == auth()->user()->id ? 1 : $request->id_role;
        $this->userRepo->update($id, $data);
        return back()->with('alert-success', trans('alert.update.success'));
    }

    function showFormResetPassword($id)
    {
        return view('user.reset_password', compact('id'));
    }

    function resetPassword(ResetPassword $request, $id)
    {
        $data = $request->only('password');
        $data['password'] = Hash::make($data['password']);
        $this->userRepo->findOrFail($id)->update($data);
        return redirect(route('user.edit', ['id' => $id]))
            ->with('alert-success', trans('passwords.reset'));
    }

    public function search(Request $request)
    {
        $columns = $request->only(['id', 'name', 'email', 'id_role', 'id_department']);
        $departments = $this->departmentRepo->all();
        $roles = $this->roleRepo->all();
        $users = $this->userRepo->search($columns, ['id', 'id_role', 'id_department']);
        return view('user.index', compact('users', 'roles', 'departments'));
    }

    public function export_excel()
    {
        return Excel::download(new ExportUser, 'users.xlsx');
    }

    public function download_template()
    {
        $file = public_path() . "/excel_template/users_template.xlsx";
        return response()->download($file, 'users_template.xlsx');
    }

    public function import_excel()
    {
        $users = Excel::toCollection(new ImportUser, request()->file('file_excel'));
        $error = [];
        foreach ($users[0] as $key => $item) {
            $department = $this->departmentRepo->where('name', $item[7])->first();
            $position = $this->positionRepo->where('name', $item[8])->first();
            $role = $this->roleRepo->where('name', $item[9])->first();
            throw_if(is_null($department || $role || $position), new ImportExcelException());
            if ($item->filter()->isEmpty()) {
                break;
            };
            try {
                $user = [
                    'id' => $item[0],
                    'name' => $item[1],
                    'email' => $item[2],
                    'password' => Hash::make($item[3]),
                    'tel' => $item[4],
                    'dob' => transformDateExcel($item[5]),
                    'id_card' => $item[6],
                    'id_department' => $department->id,
                    'id_department' => $department->id,
                    'id_position' => $position->id,
                    'id_role' => $role->id,
                ];
                DB::transaction(function () use ($user) {
                    $this->userRepo->create($user);
                });
            } catch (\Throwable $th) {
                $index = $key + 1;
                array_push($error, "Hàng thứ $index");
            }
        }
        if (!empty($error)) {
            $message = sprintf('Có %s hàng thất bại:\n%s', count($error), join('\n', $error));
            return redirect(route('user.index'))->with('alert-result', $message)->with('alert-success', 'Import Excel thành công!');
        }
        return redirect(route('user.index'))->with('alert-success', 'Import Excel thành công!');
    }

    public function handle_account($id)
    {
        $user = $this->userRepo->findOrFail($id);
        $user->update([
            'is_disabled' => !$user->is_disabled
        ]);
        return back()->with('alert-success', trans('alert.update.success'));
    }
}
