<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
     */
    public function boot(): void
    {
        $this->registerPolicies();

        $this->define_gates();
        $this->create_permissions();
    }

    /**
     * Define the authorization gates.
     */
    public function define_gates(): void
    {
        Gate::define('view-videos', function (User $user) {
            return $user->hasRole('video-manager') || $user->hasRole('super-admin');
        });

        Gate::define('manage-videos', function (User $user) {
            return $user->hasRole('super-admin');
        });
    }


    /**
     * Create the permissions.
     */
    public function create_permissions(): void
    {
        Gate::define('create-users', function (User $user) {
            return $user->hasRole('super-admin');
        });

        Gate::define('edit-users', function (User $user) {
            return $user->hasRole('super-admin');
        });

        Gate::define('delete-users', function (User $user) {
            return $user->hasRole('super-admin');
        });
    }
}
