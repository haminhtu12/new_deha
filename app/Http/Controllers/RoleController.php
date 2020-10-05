<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\EditRoleRequest;
use App\Model\Permission;
use App\Model\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $permissionsParent = $this->permission->where('parent_id', 0)->get();           //orm
        $roles = $this->role->paginate(2);
        return view('roles.index')->with(['roles' => $roles, 'permissionsParent' => $permissionsParent]);
    }

    public function store(CreateRoleRequest $request)
    {

        $role = $this->role->create($request->all());
        $role->permissions()->attach($request->permission_id);
        return response(['role' => $role]);
    }


    public function edit($id)
    {
        $role = $this->role->findOrFail($id)->load('permissions');
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return response()->json(['role' => $role, 'rolePermissions' => $rolePermissions]);

    }

    public function update(Request $request, $id)
    {
        $role = $this->role->findOrFail($id)->load('permissions');
        $role->update($request->all());
        $role->assignPermissions($request->permission_id);
        return response()->json(['role' => $role]);
    }

    public function destroy($id)
    {
        $this->role->destroy($id);
        return response()->json(['data' => 'Delete success role']);
    }

    public function list()
    {
        $roles = $this->role->all();
        return view('roles.list')->with(['roles' => $roles]);
    }
}
