<?php

namespace App\Providers;

use App\Model\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            Gate::define($permission->key_code, function ($user) use ($permission) {
                return $user->checkPermissionAccess($permission->key_code);
            });
        }

    }
}
