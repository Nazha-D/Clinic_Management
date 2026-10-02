<?php

namespace App\Policies;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DoctorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
 public function before(User $user):?bool
    {
      if($user->hasRole('super_admin'))
        return true;
    return null;
    }


    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('show_all_doctors');
    }

    /**
     * Determine whether the user hasPermissionTo view the model.
     */
    public function view(User $user, Doctor $model): bool
    {
        return $user->hasPermissionTo('show_doctor') || $user->id===$model->user_id ;
    }

    /**
     * Determine whether the user hasPermissionTo create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_doctor') ;
    }

    /**
     * Determine whether the user hasPermissionTo update the model.
     */
    public function update(User $user, Doctor $model): bool
    {
              return $user->hasPermissionTo('update_doctor') || $user->id===$model->user_id;
    }

    /**
     * Determine whether the user hasPermissionTo delete the model.
     */
    public function delete(User $user, Doctor $model): bool
    {
         if ($user->id === $model->user_id) {
            return false;
        }

        return $user->hasPermissionTo('delete_doctor');
    }

    /**
     * Determine whether the user hasPermissionTo restore the model.
     */
    public function restore(User $user,Doctor $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user hasPermissionTo permanently delete the model.
     */
    public function forceDelete(User $user, Doctor $model): bool
    {
        return false;
    }
}
