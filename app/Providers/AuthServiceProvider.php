<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        Gate::define('update-customer', function (User $user, $item) {
            return $user->id === $item->distributor_id;
        });

        Gate::define('admin-only',function(User $user) {
            return $user->set_as == 1;
        });
        Gate::define('distributor-only',function(User $user) {
            return $user->set_as == 0;
        });
    }
}
