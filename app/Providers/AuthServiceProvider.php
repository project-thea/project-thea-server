<?php

namespace App\Providers;

use App\Models\Role;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // User role
        Gate::define('isUser', function ($user) {
            return $user->role_id == Role::IS_USER;
        });

        // Admin role
        Gate::define('isAdmin', function ($user) {
            return $user->role_id == Role::IS_ADMIN;
        });

        // Lab-technician role
        Gate::define('isLabTechnician', function ($user) {
            return $user->role_id == Role::IS_LAB_TECHNICIAN;
        });
    }
}
