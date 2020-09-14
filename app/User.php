<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Model\Role;

define('FILE_PATH', config('pathupload.path_upload_avatar'));

class User extends Authenticatable
{

    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'status',
        'avatar',
        'phone'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');

    }

    public function createUser($data, $avatar = null)
    {

        if (isset($avatar) && $avatar != '') {
            $data['avatar'] = $this->insertPhoto($avatar);
        }

        return $this->create($data);
    }

    public function upDateUser($id, $data = null, $avatar = null)
    {
        $user = $this->findOrFail($id);
        $data['avatar'] = $this->updatePhoto($avatar, $user['avatar']);
        $user->update($data);

        return $user;
    }

    public function insertPhoto($file = null)
    {
        $filename = '';
        if ($this->isVerify($file)) {
            $filename = $file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(60, 60);
            $image_resize->save(public_path(FILE_PATH . time() . $filename));
        }
        return time() . $filename;
    }

    public function isVerify($file): bool
    {
        return ($file != null && $file != '');
    }

    public function updatePhoto($file, $currentFile)
    {
        $filename = $currentFile;
        if ($this->isVerify($file)) {
            if ($currentFile) {
                File::delete(FILE_PATH . $currentFile);
            }
            $filename = $this->insertPhoto($file);
        }
        return $filename;
    }

    public function search($searchText, $field)
    {
        return !$field ? $this->withSearch($searchText)->paginate(1) : $this->withStatus($field)->paginate(1);
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

        return $active ? $query->where('status', $active) : null ;
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

}
