<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
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
        'App\Models\RequestNote' => 'App\Policies\RequestNotePolicy',
        'App\Models\PeriodRegistration' => 'App\Policies\PeriodRegistrationPolicy',
        'App\Models\HandoverNote' => 'App\Policies\HandoverNotePolicy',
        'App\Models\LogLimit' => 'App\Policies\LogLimitPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
         
        if (!$this->app->runningInConsole()) {
            foreach(Permission::all() as $permission) {
                Gate::define($permission->name, function($user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        }
    }
}
