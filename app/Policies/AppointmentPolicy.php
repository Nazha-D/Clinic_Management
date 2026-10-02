<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\App;

class AppointmentPolicy
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
        return $user->hasPermissionTo('show_all_appointments');
    }

    /**
     * Determine whether the user hasPermissionTo view the model.
     */
    public function view(User $user, Appointment $model): bool
    {
        
    if ($user->hasRole('doctor')) {

        $doctorUserId = $user->id;
         return ($model->doctor && $model->doctor->user_id === $user->id) || 
               $user->hasPermissionTo('show_appointment');
    }
    
    return $user->hasPermissionTo('show_appointment');
    }

    /**
     * Determine whether the user hasPermissionTo create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('book_appointment') ;
    }

    /**
     * Determine whether the user hasPermissionTo update the model.
     */
    public function update(User $user, Appointment $model): bool
    {
              return $user->hasPermissionTo('update_appointment');
    }
 /**
     * Determine whether the user hasPermissionTo change the status the model.
     */
       public function change_status(User $user, Appointment $model): bool
    {
              return $user->hasPermissionTo('change_appointment_status');
    }
    /**
     * Determine whether the user hasPermissionTo delete the model.
     */
    public function delete(User $user, Appointment $model): bool
    {
       
        return $user->hasPermissionTo('delete_appointment');
    }

    /**
     * Determine whether the user hasPermissionTo restore the model.
     */
    public function restore(User $user, Appointment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user hasPermissionTo permanently delete the model.
     */
    public function forceDelete(User $user, Appointment $model): bool
    {
        return false;
    }
}
