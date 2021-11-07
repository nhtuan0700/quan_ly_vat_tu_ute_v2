<?php

namespace App\Http\Controllers;

use App\Exports\ExportUser;
use App\Exports\ExportUserTemplate;
use App\Imports\ImportUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\User\StoreUser;
use App\Http\Requests\User\UpdateUser;
use App\Repositories\Role\RoleInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\User\ResetPassword;
use App\Repositories\DonVi\DonViInterface;
use App\Repositories\HanMuc\HanMucInterface;

class UserController extends Controller
{
    public $userRepository;
    public $roleRepostitory;
    public $donViRepository;
    public $hanMucRepository;

    public function __construct(
        UserInterface $userInterface,
        RoleInterface $roleInterface,
        DonViInterface $donViInterface,
        HanMucInterface $hanMucInterface
    ) {
        $this->userRepository = $userInterface;
        $this->roleRepostitory = $roleInterface;
        $this->donViRepository = $donViInterface;
        $this->hanMucRepository = $hanMucInterface;
    }

    public function index()
    {
        $users = $this->userRepository->listExceptAdmin();
        $list_donvi = $this->donViRepository->all();
        $roles = $this->roleRepostitory->all();
        return view('user.index', compact('users', 'roles', 'list_donvi'));
    }

    public function create()
    {
        $roles = $this->roleRepostitory->all();
        $list_donvi = $this->donViRepository->all();
        return view('user.create', compact('roles', 'list_donvi'));
    }

    public function store(StoreUser $request)
    {
        $data = $request->only(['name', 'tel', 'dob', 'cmnd', 'email', 'password', 'id_role', 'id_donvi']);
        $data['password'] = Hash::make($data['password']);
        $new = $this->userRepository->create($data);
        return redirect(route('user.edit', ['id' => $new->id]))
            ->with('alert-success', trans('alert.create.success'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->findOrFail($id);
        $roles = $this->roleRepostitory->all();
        $list_donvi = $this->donViRepository->all();
        $list_hanmuc = $this->hanMucRepository->listHanMucByUser($id);
        return view('user.edit', compact('roles', 'user', 'list_donvi', 'list_hanmuc'));
    }

    function showFormResetPassword($id)
    {
        return view('user.reset_password', compact('id'));
    }

    function resetPassword(ResetPassword $request, $id)
    {
        $data = $request->only('password');
        $data['password'] = Hash::make($data['password']);
        $this->userRepository->findOrFail($id)->update($data);
        return redirect(route('user.edit', ['id' => $id]))
            ->with('alert-success', trans('passwords.reset'));
    }

    public function update(UpdateUser $request, $id)
    {
        $data = $request->only(['name', 'tel', 'dob', 'cmnd', 'id_donvi']);
        $data['id_role'] = $id == auth()->user()->id ? 1 : $request->id_role;
        $this->userRepository->update($id, $data);
        return back()->with('alert-success', trans('alert.update.success'));
    }

    public function search(Request $request)
    {
        $columns = $request->only(['id', 'name', 'email']);
        $columns['id_role'] = $request->role;
        $columns['id_donvi'] = $request->donvi;
        $list_donvi = $this->donViRepository->all();
        $roles = $this->roleRepostitory->all();
        $users = $this->userRepository->listExceptAdmin($columns);
        return view('user.index', compact('users', 'roles', 'list_donvi'));
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
        foreach ($users[0] as $key => $value) {
            try {
                $user = [
                    'id' => $value[0],
                    'name' => $value[1],
                    'email' => $value[2],
                    'password' => Hash::make($value[3]),
                    'tel' => $value[4],
                    'dob' => transformDateExcel($value[5]),
                    'cmnd' => $value[6],
                    'id_role' => $value[7],
                    'id_donvi' => $value[8],
                ];
                $this->userRepository->create($user);
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

    public function updateHanMuc(Request $request, $id_user)
    {
        try {
            foreach ($request->hanmuc as $id_vanphongpham => $qty_max) {
                $this->hanMucRepository->findItem($id_user, $id_vanphongpham)->update([
                    'qty_max' => intval($qty_max)
                ]);
            }
        } catch (\Throwable $th) {
            return back()->with('alert-fail', 'Cập nhật hạn mức thất bại');
        }
        return back()->with('alert-success', 'Cập nhật hạn mức thành công');
    }
}
