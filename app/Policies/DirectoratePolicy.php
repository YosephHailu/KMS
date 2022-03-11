<?php

namespace App\Policies;

use App\User;
use App\Directorate;
use Illuminate\Auth\Access\HandlesAuthorization;

class DirectoratePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the directorate.
     *
     * @param  \App\User  $user
     * @param  \App\Directorate  $directorate
     * @return mixed
     */
    public function view(User $user, Directorate $directorate)
    {
        //
        return $user->hasPermissionTo('all');
    }

    /**
     * Determine whether the user can create directorates.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->hasPermissionTo('all');
    }

    /**
     * Determine whether the user can update the directorate.
     *
     * @param  \App\User  $user
     * @param  \App\Directorate  $directorate
     * @return mixed
     */
    public function update(User $user, Directorate $directorate)
    {
        //
        return $user->hasPermissionTo('all');
    }

    /**
     * Determine whether the user can delete the directorate.
     *
     * @param  \App\User  $user
     * @param  \App\Directorate  $directorate
     * @return mixed
     */
    public function delete(User $user, Directorate $directorate)
    {
        //
        return $user->hasPermissionTo('all');
    }

    /**
     * Determine whether the user can restore the directorate.
     *
     * @param  \App\User  $user
     * @param  \App\Directorate  $directorate
     * @return mixed
     */
    public function restore(User $user, Directorate $directorate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the directorate.
     *
     * @param  \App\User  $user
     * @param  \App\Directorate  $directorate
     * @return mixed
     */
    public function forceDelete(User $user, Directorate $directorate)
    {
        //
    }
}
