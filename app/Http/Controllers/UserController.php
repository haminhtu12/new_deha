<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->address = $request->address;
        $user->password = $request->password;
        $user->level = 1;
        $user->save();
        return  response(['user'=>$user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json([
            'user'=>$user,
            'status'=>200
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user ->update($request->all());
        return  response()->json(['user'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return  response()->json(['data'=>'remove']);
    }

    public function list(){
        $users = $this->user->all();
        return view('users.list')->with(['users'=>$users]);
    }
    public function search(Request $request){
        $searchText = $request->search;
        $user = User::select()->where('name','like',"%$searchText%")->orwhere('email','like',"%$searchText%")->get();
        return view('users.list')->with(['users'=>$user]);
    }
    public function changeStatus($id){
        $user = User::find($id);
        if($user->status == 'active'){
            $user->status = 'inactive';
        }else{
            $user->status = 'active';
        }
        $user->save();
    }
    public function filter($field){

        if ($field =='all'){
            $users = $this->user->all();
        }elseif ($field =='active'){
            $users = User::select()->where('status',$field)->get();
        }else{
            $users = User::select()->where('status',$field)->get();
        }
        return view('users.list')->with(['users'=>$users]);
    }
}
