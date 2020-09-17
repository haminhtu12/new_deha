<?php

namespace App\Http\Controllers;

use App\Model\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        $roles = $this->role->paginate(2);
        return view('roles.index')->with(['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $role = $this->role->create($request->all());

        return response(['role' => $role]);

    }


    public function edit($id)
    {
        $role = $this->role->findOrFail($id);
        return response()->json(['role' => $role,]);

    }

    public function update(Request $request, $id)
    {
        $role = $this->role->findOrFail($id)->update($request->all());
        return response()->json(['role' => $role]);

    }

    public function destroy($id)
    {
        $this->role->destroy($id);
    }

    public function list()
    {

        $roles = $this->role->all();
        return view('roles.list')->with(['roles' => $roles]);
    }
}
