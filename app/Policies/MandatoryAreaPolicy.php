<?php

namespace App\Policies;

use App\MandatoryArea;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MandatoryAreaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any mandatory areas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the mandatory area.
     *
     * @param  \App\User  $user
     * @param  \App\MandatoryArea  $mandatoryArea
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create mandatory areas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return PermissionPolicy::hasPermission($user, 'create mandatory_areas');
    }

    /**
     * Determine whether the user can update the mandatory area.
     *
     * @param  \App\User  $user
     * @param  \App\MandatoryArea  $mandatoryArea
     * @return mixed
     */
    public function update(User $user)
    {
        return PermissionPolicy::hasPermission($user, 'update mandatory_areas');
    }

    /**
     * Determine whether the user can delete the mandatory area.
     *
     * @param  \App\User  $user
     * @param  \App\MandatoryArea  $mandatoryArea
     * @return mixed
     */
    public function delete(User $user)
    {
        return PermissionPolicy::hasPermission($user, 'delete mandatory_areas');
        
    }

    /**
     * Determine whether the user can restore the mandatory area.
     *
     * @param  \App\User  $user
     * @param  \App\MandatoryArea  $mandatoryArea
     * @return mixed
     */
    public function restore(User $user)
    {
        return PermissionPolicy::hasPermission($user, 'delete mandatory_areas');
    }

    /**
     * Determine whether the user can permanently delete the mandatory area.
     *
     * @param  \App\User  $user
     * @param  \App\MandatoryArea  $mandatoryArea
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return PermissionPolicy::hasPermission($user, 'delete mandatory_areas');
    }
}
