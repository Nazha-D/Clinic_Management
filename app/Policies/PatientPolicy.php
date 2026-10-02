<?php

namespace App\Policies;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PatientPolicy
{
  
   public function before(User $user):?bool
    {
      if($user->hasRole('super_admin'))
        return true;
    return null;
    }
  /**
     * Determine whether the user can view any models.
     */

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('show_all_patients');
    }

    /**
     * Determine whether the user hasPermissionTo view the model.
     */
    public function view(User $user, Patient $model): bool
    {
        return $user->hasPermissionTo('show_patient');
    }

    /**
     * Determine whether the user hasPermissionTo create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_patient') ;
    }

    /**
     * Determine whether the user hasPermissionTo update the model.
     */
    public function update(User $user, Patient $model): bool
    {
              return $user->hasPermissionTo('update_patient') ;
    }

    /**
     * Determine whether the user hasPermissionTo delete the model.
     */
    public function delete(User $user, Patient $model): bool
    {
       

        return $user->hasPermissionTo('delete_patient');
    }

    /**
     * Determine whether the user hasPermissionTo restore the model.
     */
    public function restore(User $user, Patient $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user hasPermissionTo permanently delete the model.
     */
    public function forceDelete(User $user,Patient $model): bool
    {
        return false;
    }
   
    }
