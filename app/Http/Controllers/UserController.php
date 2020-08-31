<?php

namespace App\Http\Controllers;

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
       $users = $this->user->all();

       return view('users.index')->with(['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user =  $this->user->createUser($request->name,$request->email,$request->phone,$request->status,$request->address,$request->password);
        return  response(['user'=>$user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return response()->json([
            'user'=>User::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user =  $this->user->upDateUser($id,$request);
        return  response()->json(['user'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->user->deleteUser($id);
        return  response()->json(['data'=>'remove']);
    }

    public function list(){
        return view('users.list')->with(['users'=>$this->user->all()]);
    }
    public function search(Request $request){
        $user =  $this->user->searchUser($request);
        return view('users.list')->with(['users'=>$user]);
    }
    public function changeStatus($id){
         $this->user->changeStatusUser($id);
    }
    public function filter($field){
        $users =  $this->user->fileterUserStatus($field);
        return view('users.list')->with(['users'=>$users]);
    }
}
