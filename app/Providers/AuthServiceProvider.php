<?php

namespace App\Providers;

use App\Component;
use App\Grade;
use App\MandatoryArea;
use App\Ova;
use App\Role;
use App\School;
use App\SchoolClass;
use App\Subject;
use App\User;
use App\Policies\ComponentPolicy;
use App\Policies\GradePolicy;
use App\Policies\MandatoryAreaPolicy;
use App\Policies\OvaPolicy;
use App\Policies\RolePolicy;
use App\Policies\SchoolClassPolicy;
use App\Policies\SchoolPolicy;
use App\Policies\SubjectPolicy;
use App\Policies\UserPolicy;
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
        School::class => SchoolPolicy::class,
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        MandatoryArea::class => MandatoryAreaPolicy::class,
        Subject::class => SubjectPolicy::class,
        Grade::class => GradePolicy::class,
        SchoolClass::class => SchoolClassPolicy::class,
        Component::class => ComponentPolicy::class,
        Ova::class => OvaPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
