<?php

namespace App\Policies;

use App\Models\User;


class UserPolicy
{
    /**
     * Determine whether the user hasPermissionTo view any models.
     */


    public function before(User $user):?bool
    {
      if($user->hasRole('super_admin'))
        return true;
    return null;
    }


    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('show_all_users');
    }

    /**
     * Determine whether the user hasPermissionTo view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->hasPermissionTo('show_user') || $user->id===$model->id ;
    }

    /**
     * Determine whether the user hasPermissionTo create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_user') ;
    }

    /**
     * Determine whether the user hasPermissionTo update the model.
     */
    public function update(User $user, User $model): bool
    {
              return $user->hasPermissionTo('update_user') || $user->id===$model->id;
    }

    /**
     * Determine whether the user hasPermissionTo delete the model.
     */
    public function delete(User $user, User $model): bool
    {
         if ($user->id === $model->id) {
            return false;
        }

        return $user->hasPermissionTo('delete_user');
    }

    /**
     * Determine whether the user hasPermissionTo restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user hasPermissionTo permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
