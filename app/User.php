<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Intervention\Image\Facades\Image;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Orders::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);

    }

    public function createUser($data, $avatar)
    {
        $data['avatar'] = $this->insertPhoto($avatar);
        $user = $this->create($data);
        return $user;
    }

    public function upDateUser($id, $data = null, $avatar = null)
    {
        $user = User::findOrFail($id);
        $data['avatar'] = $this->insertPhoto($avatar);
        $user->update($data);
        $user->save();
        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function searchUser($searchText)
    {

        return User::select()->where('name', 'like', "%$searchText%")->where('email', 'like', "%$searchText%")->get();
    }

    public function changeStatusUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->status == 'active') {
            $user->status = 'inactive';
        } else {
            $user->status = 'active';
        }
        $user->save();
        return $user;
    }

    public function filterUserStatus($field)
    {
        $field = $field == 'all' ? null : $field;

        return $this->withActive($field)->get();
    }

    public function scopeWithActive($query, $active)
    {
        return $active ? $query->where('status', $active) : null;
    }

    public static function insertPhoto($file = null)
    {
        $filename = '';
        if ($file != null && $file != '') {

            $filename = $file->getClientOriginalName();

            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(60, 60);
            $image_resize->save(public_path('images/Avater/'.$filename));
        }
        return $filename;
    }

    public function checkRoles($roles)
    {
        if (!is_array($roles)) {
            $roles = [$roles];
        }
        if (!$this->hasAnyRole($roles)) {
            auth()->logout();
            abort(404);
        }
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
