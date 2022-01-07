<?php

namespace App\Http\Controllers;

use App\Exceptions\ImportExcelException;
use App\Models\User;
use App\Exports\ExportUser;
use App\Imports\ImportUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportUserTemplate;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\User\StoreUser;
use App\Http\Requests\User\UpdateUser;
use App\Repositories\Role\RoleInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\User\ResetPassword;
use Illuminate\Support\Facades\Notification;
use App\Repositories\Department\DepartmentInterface;
use App\Notifications\UpdateLimitStationeryNotification;
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
        return view('user.edit', compact('roles', 'user', 'departments', 'limit_stationeries', 'positions'));
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
            throw_if(is_null($department || $role), new ImportExcelException());
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
                    'id_position' => optional($position)->id,
                    'id_role' => $role->id,
                ];
                $this->userRepo->create($user);
                DB::transaction(function () use ($user) {
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

    public function updateLimit(Request $request, $id_user)
    {
        try {
            DB::transaction(function () use ($request, $id_user) {
                $is_edit = false;
                foreach ($request->limits as $id_stationery => $qty_max) {
                    $limit = $this->limitRepo->findItem($id_user, $id_stationery);
                    if (is_null($limit->first())) {
                        $this->limitRepo->create([
                            'id_user' => $id_user,
                            'id_stationery' => $id_stationery,
                            'qty_used' => 0,
                            'qty_max' => $qty_max,
                            'quarter_year' => quarter_of_year(),
                            'year' => now()->year
                        ]);
                    } else {
                        if ($limit->first()->qty_max != $qty_max) {
                            $limit->update([
                                'qty_max' => $qty_max
                            ]);
                            $is_edit = true;
                        }
                    }
                }
                if ($is_edit) {
                    Notification::send(User::find($id_user), new UpdateLimitStationeryNotification());
                }
            });
        } catch (\Throwable $th) {
            return $th->getMessage();
            return back()->with('alert-fail', 'Cập nhật hạn mức thất bại');
        }
        return back()->with('alert-success', 'Cập nhật hạn mức thành công');
    }

    public function handle_account(Request $request, $id)
    {
        $user = $this->userRepo->findOrFail($id);
        $user->update([
            'is_disabled' => !!(int) $request->is_block
        ]);
        return back()->with('alert-success', trans('alert.update.success'));
    }
}
