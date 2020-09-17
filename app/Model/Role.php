<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";
    protected  $fillable = ['name','description','display_name'];

    public function user()
    {
        return $this->belongsToMany(User::class);

    }
}
