<?php

namespace App\Policies;

use App\Presentation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PresentationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any presentations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the presentation.
     *
     * @param  \App\User  $user
     * @param  \App\Presentation  $presentation
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create presentations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return PermissionPolicy::hasPermission($user, 'create presentations');
    }

    /**
     * Determine whether the user can update the presentation.
     *
     * @param  \App\User  $user
     * @param  \App\Presentation  $presentation
     * @return mixed
     */
    public function update(User $user)
    {
        return PermissionPolicy::hasPermission($user, 'update presentations');
        
    }

    /**
     * Determine whether the user can delete the presentation.
     *
     * @param  \App\User  $user
     * @param  \App\Presentation  $presentation
     * @return mixed
     */
    public function delete(User $user)
    {
        return PermissionPolicy::hasPermission($user, 'delete presentations');
        
    }
}
