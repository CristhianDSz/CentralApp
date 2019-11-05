<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user ($user) has a permission action ($name)
     *
     * @param User $user
     * @param string $name
     * @return boolean
     */
    public static function hasPermission(User $user, $name)
    {
        foreach ($user->role->permissions as $permission) {
            if ($permission->name === $name) {
                return true;
            }
        }
        return false;
    }
}
