<?php

namespace App\Policies;

use App\User;
use App\Finance;
use Illuminate\Auth\Access\HandlesAuthorization;

class FinancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the finance.
     *
     * @param  \App\User  $user
     * @param  \App\Finance  $finance
     * @return mixed
     */
    public function view(User $user, Finance $finance)
    {
        //
    }

    /**
     * Determine whether the user can create finances.
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
     * Determine whether the user can update the finance.
     *
     * @param  \App\User  $user
     * @param  \App\Finance  $finance
     * @return mixed
     */
    public function update(User $user, Finance $finance)
    {
        //
        return $user->hasPermissionTo('all');
    }

    /**
     * Determine whether the user can delete the finance.
     *
     * @param  \App\User  $user
     * @param  \App\Finance  $finance
     * @return mixed
     */
    public function delete(User $user, Finance $finance)
    {
        //
        return $user->hasPermissionTo('all');
    }

    /**
     * Determine whether the user can restore the finance.
     *
     * @param  \App\User  $user
     * @param  \App\Finance  $finance
     * @return mixed
     */
    public function restore(User $user, Finance $finance)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the finance.
     *
     * @param  \App\User  $user
     * @param  \App\Finance  $finance
     * @return mixed
     */
    public function forceDelete(User $user, Finance $finance)
    {
        //
    }
}
