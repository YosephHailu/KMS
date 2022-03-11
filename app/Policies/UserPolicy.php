<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        //
        if ($model->hasAnyPermission('all')) {
            if ($user->id == $model->id)
                return true;
            else
                return false;
        }

        if ($user->id == $model->id || $user->hasAnyPermission('all')) {
            return true;
        }

        if ($user->hasAnyPermission('manage directorate')) {
            if ($user->directorate->id == $model->directorate->id)
                return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->hasAnyPermission(['all', 'manage directorate']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        //
        if ($model->hasAnyPermission('all')) {
            if ($user->id == $model->id)
                return true;
            else
                return false;
        }

        if ($user->id == $model->id || $user->hasAnyPermission('all')) {
            return true;
        }

        if ($user->hasAnyPermission('manage directorate')) {
            if ($user->directorate->id == $model->directorate->id)
                return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
        if ($model->hasAnyPermission('all')) {
            return false;
        }

        if ($user->hasAnyPermission('all')) {
            return true;
        }

        if ($user->id == $model->id)
            return false;

        if ($user->hasAnyPermission('manage directorate')) {
            if ($user->directorate->id == $model->directorate->id)
                return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function resetPassword(User $user, User $model)
    {
        //
        if ($model->hasAnyPermission('all')) {
            if ($user->id == $model->id)
                return true;
            else
                return false;
        }

        if ($user->id == $model->id || $user->hasAnyPermission('all')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can assign role to the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function assignRole(User $user, User $model)
    {
        //
        if ($model->hasAnyPermission('all')) {
            if ($user->id == $model->id)
                return true;
            else
                return false;
        }

        if ($user->hasAnyPermission('all')) {
            return true;
        }

        if ($user->hasAnyPermission('manage directorate')) {
            if ($user->directorate->id == $model->directorate->id)
                return true;
        }

        return false;
    }
    
    /**
     * Determine whether the user can remove role from the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function revokeRole(User $user, User $model)
    {
        //
        if ($model->hasAnyPermission('all')) {
            if ($user->id == $model->id)
                return true;
            else
                return false;
        }

        if ($user->hasAnyPermission('all')) {
            return true;
        }

        if ($user->hasAnyPermission('manage directorate')) {
            if ($user->directorate->id == $model->directorate->id)
                return true;
        }

        return false;
    }
    
    /**
     * Determine whether the user can assign role to the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function updateAccessLevel(User $user, User $model)
    {
        //
        if ($model->hasAnyPermission('all')) {
            if ($user->id == $model->id)
                return true;
            else
                return false;
        }

        if ($user->hasAnyPermission('all')) {
            return true;
        }

        if ($user->hasAnyPermission('manage directorate')) {
            if ($user->directorate->id == $model->directorate->id)
                return true;
        }

        return false;
    }
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function updateDirectorate(User $user, User $model)
    {
        //
        if ($model->hasAnyPermission('all') && !$user->hasAnyPermission('all')) {
                return false;
        }

        if ($user->hasAnyPermission('all')) {
                return true;
        }

        if ($model->hasAnyPermission('manage directorate')) {
            return false;
        }

        if ($user->hasAnyPermission('manage directorate')) {
            if ($user->directorate->id == $model->directorate->id)
                return true;
        }

        return false;
    }

}
