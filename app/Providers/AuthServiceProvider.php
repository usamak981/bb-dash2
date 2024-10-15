<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('update-user', function (User $loggedInUser, User $user) {
            return $loggedInUser->hasRole(User::SUPER_ADMIN) ||
                ($user->hasRole(User::ADMIN) && $loggedInUser->id == $user->id) ||
                ($user->hasRole(User::USER) && $loggedInUser->can('users'));
        });

        Gate::define('delete-user', function (User $loggedInUser, User $user) {
            return $user->id != $loggedInUser->id &&
                !$user->hasRole(User::SUPER_ADMIN) &&
                ($loggedInUser->hasRole(User::SUPER_ADMIN) ||
                ($user->hasRole(User::ADMIN) && $loggedInUser->id == $user->id) ||
                ($user->hasRole(User::USER) && $loggedInUser->can('users')));
        });
    }
}
