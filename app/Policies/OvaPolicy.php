<?php

namespace App\Policies;

use App\Ova;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OvaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any ovas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the ova.
     *
     * @param  \App\User  $user
     * @param  \App\Ova  $ova
     * @return mixed
     */
    public function view(User $user, Ova $ova)
    {
        //
    }

    /**
     * Determine whether the user can create ovas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the ova.
     *
     * @param  \App\User  $user
     * @param  \App\Ova  $ova
     * @return mixed
     */
    public function update(User $user, Ova $ova)
    {
        //
    }

    /**
     * Determine whether the user can delete the ova.
     *
     * @param  \App\User  $user
     * @param  \App\Ova  $ova
     * @return mixed
     */
    public function delete(User $user, Ova $ova)
    {
        //
    }

    /**
     * Determine whether the user can restore the ova.
     *
     * @param  \App\User  $user
     * @param  \App\Ova  $ova
     * @return mixed
     */
    public function restore(User $user, Ova $ova)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the ova.
     *
     * @param  \App\User  $user
     * @param  \App\Ova  $ova
     * @return mixed
     */
    public function forceDelete(User $user, Ova $ova)
    {
        //
    }
}
