<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use phpDocumentor\Reflection\Types\This;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('users.index')->with(['users' => $this->user->all()]);
    }
    public function store(CreateUserRequest $request)
    {
        $user = $this->user->createUser($request->all(), $request->file('avatar'));
        return response(['user' => $user]);
    }
    public function edit(int $id)
    {
        return response()->json([
            'user' => $this->user->findOrFail($id),
        ]);
    }
    public function update(EditUserRequest $request, int $id)
    {
        $user = $this->user->upDateUser($id, $request->all(), $request->file('avatar'));
        return response()->json(['user' => $user]);
    }
    public function destroy(int $id)
    {
        $this->user->destroy($id);
        return response()->json(['data' => 'remove']);
    }
//    public function list()
//    {
//        return view('users.list')->with(['users' => $this->user->all()]);
//    }

    public function search(Request $request)
    {
        return view('users.list')->with(['users' => $this->user->search($request->search)]);
    }

    public function changeStatus($id)
    {
        $this->user->changeStatusUser($id);
    }

    public function filter($field)
    {
        return view('users.list')->with(['users' => $this->user->filterUserStatus($field)]);
    }
}
