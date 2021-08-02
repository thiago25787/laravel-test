<?php

namespace App\Providers;

use App\Enums\ProfileEnum;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
        Gate::define('user', function (User $user) {
            return $user && $user->profile == ProfileEnum::ADMIN;
        });
        Gate::define('approve', function (User $user) {
            return $user && $user->profile == ProfileEnum::ADMIN;
        });
        Gate::define('account', function (User $user) {
            return $user && in_array($user->profile, ProfileEnum::getValues());
        });
    }
}
