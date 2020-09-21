<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model

{
    protected $table = "permissions";
    protected  $fillable = ['name','display_name','parent_id'];

    public function permissionsChildren(){
        return $this->hasMany(Permission::class , 'parent_id');
    }
}
