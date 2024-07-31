<?php

namespace App\Providers;
use App\Policies\RolePolicy;
use App\Policies\ParametrePolicy;
use App\Policies\StructurePolicy;
use App\Policies\MonitoringPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\ValeurPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::resource('structures', StructurePolicy::class);
        Gate::resource('data', DataPolicy::class);
        Gate::resource('users', UserPolicy::class);
        Gate::resource('roles', RolePolicy::class);
        Gate::resource('permissions', PermissionPolicy::class);
        Gate::resource('parametres', ParametrePolicy::class);
        Gate::resource('valeurs', ValeurPolicy::class);
        Gate::resource('gerants', GerantPolicy::class);
        Gate::resource('prescripteurs', PrescripteurPolicy::class);
    }
}
