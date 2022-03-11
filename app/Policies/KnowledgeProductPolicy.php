<?php

namespace App\Policies;

use App\User;
use App\KnowledgeProduct;
use Illuminate\Auth\Access\HandlesAuthorization;

class KnowledgeProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the knowledge product.
     *
     * @param  \App\User  $user
     * @param  \App\KnowledgeProduct  $knowledgeProduct
     * @return mixed
     */
    public function view(User $user, KnowledgeProduct $knowledgeProduct)
    {
        //
        if ($user->hasAnyPermission('all') || $user->id == $knowledgeProduct->user_id){
            return true;
        }
        
        if ($knowledgeProduct->accessLevel->level_number <= 1 && $knowledgeProduct->approved){
            return true;
        }

        if ($user->hasAnyPermission('manage directorate')){
            if($user->directorate->id == $knowledgeProduct->directorate->id)
                return true;
        }

        if(!$knowledgeProduct->approved)
            return false;

        if($knowledgeProduct->accessLevel->level_number <= 0)
            return true;

        if($knowledgeProduct->accessLevel->level_number <= $user->accessLevel->level_number)
            return true;
                
        return false;

    }

    /**
     * Determine whether the user can create knowledge products.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->hasAnyPermission(['all', 'manage knowledge']);
    }

    /**
     * Determine whether the user can update the knowledge product.
     *
     * @param  \App\User  $user
     * @param  \App\KnowledgeProduct  $knowledgeProduct
     * @return mixed
     */
    public function update(User $user, KnowledgeProduct $knowledgeProduct)
    {
        //        
        if ($user->hasAnyPermission('all')){
            return true;
        }
        
        if ($user->hasAnyPermission('manage directorate')){
            if($user->id == $knowledgeProduct->user_id)
                return true;
            return $user->directorate->id == $knowledgeProduct->directorate->id;
        }

        return $user->id == $knowledgeProduct->user_id;
        
    }

    /**
     * Determine whether the user can delete the knowledge product.
     *
     * @param  \App\User  $user
     * @param  \App\KnowledgeProduct  $knowledgeProduct
     * @return mixed
     */
    public function delete(User $user, KnowledgeProduct $knowledgeProduct)
    {
        //
        if ($user->hasAnyPermission('all')){
            return true;
        }
        
        if ($user->hasAnyPermission('manage directorate')){
            if($user->id == $knowledgeProduct->user_id)
                return true;
            return $user->directorate->id == $knowledgeProduct->directorate->id;
        }

        
        return $user->id == $knowledgeProduct->user_id;
    }
    
    /**
     * Determine whether the user can Access the knowledge product.
     *
     * @param  \App\User  $user
     * @param  \App\KnowledgeProduct  $knowledgeProduct
     * @return mixed
     */
    public function viewKnowledge(User $user)
    {
        //
        return $user->hasAnyPermission(['all', 'manage knowledge']);
    }

    /**
     * Determine whether the user can Manage the knowledge product.
     *
     * @param  \App\User  $user
     * @param  \App\KnowledgeProduct  $knowledgeProduct
     * @return mixed
     */
    public function manageKnowledge(User $user, KnowledgeProduct $knowledgeProduct)
    {
        //
        if ($user->hasAnyPermission('all')){
            return true;
        }
        
        else if ($user->hasAnyPermission('manage directorate')){
            return $user->directorate->id == $knowledgeProduct->user->directorate->id;
        }
        
        return $user->id == $knowledgeProduct->user_id;

    }
    
    /**
     * Determine whether the user can view the knowledge product.
     *
     * @param  \App\User  $user
     * @param  \App\KnowledgeProduct  $knowledgeProduct
     * @return mixed
     */
    public function publish(User $user, KnowledgeProduct $knowledgeProduct)
    {
        //
        if ($user->hasAnyPermission('all')){
            return true;
        }

        if ($user->hasAnyPermission('manage directorate')){
            if($user->id == $knowledgeProduct->user_id)
                return true;
            return $user->directorate->id == $knowledgeProduct->directorate->id;
        }

        return false;

    }

}
