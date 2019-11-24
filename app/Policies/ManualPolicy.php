<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManualPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return PermissionPolicy::hasPermission($user, 'create manuals');
        
    }

    public function update(User $user)
    {
        return PermissionPolicy::hasPermission($user, 'update manuals');
        
    }

    public function delete(User $user)
    {
        return PermissionPolicy::hasPermission($user, 'delete manuals');
        
    }
}
