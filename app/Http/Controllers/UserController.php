<?php

namespace App\Http\Controllers;

use App\Exports\ExportUser;
use App\Imports\ImportUser;
use Illuminate\Http\Request;
use App\Exports\ExportUserTemplate;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\User\StoreUser;
use App\Http\Requests\User\UpdateUser;
use App\Repositories\Role\RoleInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\User\ResetPassword;
use App\Repositories\Department\DepartmentInterface;
use App\Repositories\LimitStationery\LimitStationeryInterface;

class UserController extends Controller
{
    private $userRepo;
    private $roleRepo;
    private $departmentRepo;
    private $limitRepo;

    public function __construct(
        UserInterface $userInterface,
        RoleInterface $roleInterface,
        DepartmentInterface $departmentInterface,
        LimitStationeryInterface $limitStationeryInterface
    ) {
        $this->userRepo = $userInterface;
        $this->roleRepo = $roleInterface;
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
        return view('user.create', compact('roles', 'departments'));
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
        $limit_stationeries = $this->limitRepo->listByUser($id);
        return view('user.edit', compact('roles', 'user', 'departments', 'limit_stationeries'));
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
        $columns = $request->only(['id', 'name', 'email']);
        $columns['id_role'] = $request->role;
        $columns['id_department'] = $request->donvi;
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
        return Excel::download(new ExportUserTemplate, 'users_template.xlsx');
    }

    public function import_excel()
    {
        // Excel::import(new ImportUser, request()->file('file_excel'));
        $users = Excel::toCollection(new ImportUser, request()->file('file_excel'));
        $error = [];
        foreach ($users[0] as $key => $item) {
            if($item->filter()->isEmpty()) {
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
                    'id_role' => $item[7],
                    'id_department' => $item[8],
                ];
                $this->userRepo->create($user);
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

    public function updateLimit(Request $request, $id_user)
    {
        try {
            foreach ($request->limits as $id_stationery => $qty_max) {
                $this->limitRepo->findItem($id_user, $id_stationery)->update([
                    'qty_max' => intval($qty_max)
                ]);
            }
        } catch (\Throwable $th) {
            return back()->with('alert-fail', 'Cập nhật hạn mức thất bại');
        }
        return back()->with('alert-success', 'Cập nhật hạn mức thành công');
    }
}
