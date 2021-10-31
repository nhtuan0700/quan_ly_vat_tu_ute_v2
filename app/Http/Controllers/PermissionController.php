<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Role\RoleInterface;

class PermissionController extends Controller
{
    protected $roleRepostitory;
    public function __construct(RoleInterface $roleRepository)
    {
        $this->roleRepostitory = $roleRepository;
    }
    
    public function index($id_role = null)
    {
        $roles = $this->roleRepostitory->all();
        $id_role = $id_role ?? $this->roleRepostitory::ADMIN;
        $permissions = DB::table('permission')
            ->leftJoin('role_permission', function ($join) use ($id_role) {
                $join->on('permission.id', '=', 'role_permission.id_permission')
                    ->where('role_permission.id_role', $id_role);
            })
            ->get();
        return view('permission.index', compact('roles', 'permissions', 'id_role'));
    }

    public function update(Request $request, $id_role = null)
    {
        $id_role = $id_role ?? $this->roleRepostitory::ADMIN;
        $role = $this->roleRepostitory->find($id_role);
        $role->permissions()->sync($request->permission);
        return back()->with('alert-success', trans('alert.update.success'));
    }
}
