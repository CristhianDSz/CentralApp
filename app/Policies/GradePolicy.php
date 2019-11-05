<?php

namespace App\Policies;

use App\Grade;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GradePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any grades.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the grade.
     *
     * @param  \App\User  $user
     * @param  \App\Grade  $grade
     * @return mixed
     */
    public function view(User $user, Grade $grade)
    {
        //
    }

    /**
     * Determine whether the user can create grades.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the grade.
     *
     * @param  \App\User  $user
     * @param  \App\Grade  $grade
     * @return mixed
     */
    public function update(User $user, Grade $grade)
    {
        //
    }

    /**
     * Determine whether the user can delete the grade.
     *
     * @param  \App\User  $user
     * @param  \App\Grade  $grade
     * @return mixed
     */
    public function delete(User $user, Grade $grade)
    {
        //
    }

    /**
     * Determine whether the user can restore the grade.
     *
     * @param  \App\User  $user
     * @param  \App\Grade  $grade
     * @return mixed
     */
    public function restore(User $user, Grade $grade)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the grade.
     *
     * @param  \App\User  $user
     * @param  \App\Grade  $grade
     * @return mixed
     */
    public function forceDelete(User $user, Grade $grade)
    {
        //
    }
}