<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use League\Flysystem\Plugin\GetWithMetadata;


class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-teacher-role',function (User $user){
            $get_role=$user->roles()->get();
            return $get_role[0]['guard']==='teacher';
        });
        Gate::define('view-admin-role',function (User $user){
            $get_role=$user->roles()->get();
            return $get_role[0]['pivot']['role_id']===1;
        });
        Gate::define('view-student-role',function (User $user){
            $get_role=$user->roles()->get();
            return $get_role[0]['guard']==='student';
        });
    }
}
