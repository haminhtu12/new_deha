<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','address','status','avatar','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function orders() {
        return $this->hasMany('App\Orders','user_id');
    }
    public function createUser($name,$email,$phone,$status,$address,$password){
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->status = $status;
        $user->address = $address;
        $user->password = $password;
        $user->level = 1;
        $user->save();
        return  $user;
    }
    public function upDateUser($id,$request){
        $user = User::findOrFail($id);
        $user ->update($request->all());
        return $user;
    }
    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
    }
    public function searchUser($request){
        $searchText = $request->search;
        $user = User::select()->where('name','like',"%$searchText%")->orwhere('email','like',"%$searchText%")->get();
        return $user;
    }
    public function changeStatusUser($id){
        $user = User::find($id);
        if($user->status == 'active'){
            $user->status = 'inactive';
        }else{
            $user->status = 'active';
        }
        $user->save();
        return $user;
    }
    public function fileterUserStatus($field){
        if ($field =='all'){
            $users = User::all();
        }elseif ($field =='active'){
            $users = User::select()->where('status',$field)->get();
        }else{
            $users = User::select()->where('status',$field)->get();
        }
        return $users;
    }


}
