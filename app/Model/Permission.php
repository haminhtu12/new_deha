<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model

{
    protected $table = "permissions";
    protected  $fillable = ['name','display_name','parent_id'];

    protected $appends = ['slug_name'];

    public function permissionsChildren(){
        return $this->hasMany(Permission::class , 'parent_id');
    }

    public function getSlugNameAttribute()
    {
        return Str::slug($this->name);
    }
}
