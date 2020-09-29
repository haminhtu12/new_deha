<?php

namespace App;

use App\Traits\HandleImage;
use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Model\Role;
use Intervention\Image\Facades\Image;

define('FILE_PATH', config('pathway.path_upload_avatar'));

//$FILE_PATH =  config('pathway.path_upload_avatar');


class User extends Authenticate
{


    use Notifiable, HandleImage;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'status', 'phone', 'address', 'avatar'];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');

    }

    public function createUser($data, $avatar = null)
    {
        if ($avatar) {
            $data['avatar'] = $this->insertPhoto($avatar);
        }
        $user = User::create($data);
        $user->roles()->sync($data['role_id'] ?? []);
        return $user;
    }

    public function upDateUser($id, $data = null, $avatar = null)
    {
        $user = $this->findOrFail($id);
        $roleIds = $data['role_id'];
        $user->roles()->sync($roleIds);
        $data['avatar'] = $this->updatePhoto($avatar, $user['avatar']);
        $user->update($data);

        return $user;
    }

    public function insertPhoto($file = null)
    {
        return $this->insertImage($file, FILE_PATH);
    }

    public function updatePhoto($file, $currentFile)
    {
        return $this->updateImage($file, $currentFile, FILE_PATH);
    }

    public function search($searchText, $field)
    {
        return $this->withSearch($searchText)->withStatus($field)->paginate(4);
    }

    public function changeStatus($id)
    {
        $user = $this->findOrFail($id);
        $user->status = $user->status == 'inactive' ? 'active' : 'inactive';
        $user->save();
        return $user;
    }

    public function scopeWithSearch($query, $searchText)
    {
        return $searchText ? $query->where('name', 'like', "%$searchText%")
            ->Orwhere('email', 'like', "%$searchText%") : null;
    }

    public function scopeWithStatus($query, $active)
    {

        $active = $active == 'all' ? null : $active;

        return $active ? $query->where('status', $active) : null;
    }


    public function hasAnyRole($roles = []): bool
    {
        return count($roles) > 0
            ? $this->roles()->whereIn('name', $roles)->count() > 0
            : false;
    }

    public function hasRole($role): bool
    {
        return (bool)$this->roles()->where('name', $role)->first();
    }

    public function checkPermissionAccess($permission)
    {
        $roles = $this->load('roles')->roles;
        foreach ($roles as $role) {
            $permissions = $role->permissions;
            if ($permissions->contains('key_code', $permission)) {
                return true;
            }
        }
        return false;
    }


}
