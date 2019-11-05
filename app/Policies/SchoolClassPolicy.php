<?php

namespace App\Policies;

use App\SchoolClass;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolClassPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any school classes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //return PermissionPolicy::hasPermission($user, "view school");
        return true;
        
    }

    /**
     * Determine whether the user can view the school class.
     *
     * @param  \App\User  $user
     * @param  \App\SchoolClass  $schoolClass
     * @return mixed
     */
    public function view(User $user)
    {
        //return PermissionPolicy::hasPermission($user, "view school");
        
    }

    /**
     * Determine whether the user can create school classes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the school class.
     *
     * @param  \App\User  $user
     * @param  \App\SchoolClass  $schoolClass
     * @return mixed
     */
    public function update(User $user)
    {
    }

    /**
     * Determine whether the user can delete the school class.
     *
     * @param  \App\User  $user
     * @param  \App\SchoolClass  $schoolClass
     * @return mixed
     */
    public function delete(User $user)
    {
        //
    }
}
