<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Model\Role;
use App\Traits\HandleImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class UserController extends Controller
{
    protected $user;
    protected $role;


    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $users = $this->user->all();
        $roles = $this->role->all();
        return view('users.index')->with(['users' => $users, 'roles' => $roles]);    //compose
    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->user->createUser($request->all(), $request->file('avatar'));
        return response(['user' => $user]);
    }

    public function edit($id)
    {

        $user = $this->user->with('roles')->findOrFail($id);
        $roleIdsUser = $user->roles->pluck('id')->toArray();
        return response()->json([
            'user' => $user,
            'role_ids_user' => $roleIdsUser,
        ]);
    }

    public function update(EditUserRequest $request, int $id)
    {
        $user = $this->user->upDateUser($id, $request->all(), $request->file('avatar'));
        return response()->json(['user' => $user]);
    }

    public function destroy(int $id)
    {
        $user = $this->user->findOrFail($id);
        $this->user->deleteImage(FILE_PATH, $user['avatar']);
        $user->destroy($id);
        return response()->json(['data' => 'remove']);
    }

    public function search(Request $request)
    {
        $data['name']= $request->name ?? null;
        $data['status']= $request->status ?? null;
        $users = $this->user->search($data);
        return view('users.list')->with(['users' => $users]);
    }

    function fetchDataPaginate(Request $request)
    {
        if ($request->ajax()) {
            $users = $this->user->paginate(4);
            return view('users.list', compact('users'))->render();
        }
    }

    public function changeStatus($id)
    {
        $this->user->changeStatus($id);
    }

    public function filter($field)
    {
        return view('users.list')->with(['users' => $this->user->filterUser($field)]);
    }
}
