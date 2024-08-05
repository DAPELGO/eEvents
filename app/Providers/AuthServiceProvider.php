<?php

namespace App\Providers;
use App\Policies\RolePolicy;
use App\Policies\EventPolicy;
use App\Policies\ValeurPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\CategoriePolicy;
use App\Policies\ParametrePolicy;

use App\Policies\StructurePolicy;
use App\Policies\MonitoringPolicy;
use App\Policies\PermissionPolicy;
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
        Gate::resource('events', EventPolicy::class);
        Gate::resource('structures', StructurePolicy::class);
        Gate::resource('categories', CategoriePolicy::class);
        Gate::resource('articles', ArticlePolicy::class);
        Gate::resource('users', UserPolicy::class);
        Gate::resource('roles', RolePolicy::class);
        Gate::resource('permissions', PermissionPolicy::class);
        Gate::resource('parametres', ParametrePolicy::class);
        Gate::resource('valeurs', ValeurPolicy::class);
        Gate::resource('prescripteurs', PrescripteurPolicy::class);
    }
}
