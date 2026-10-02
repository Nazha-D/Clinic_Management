<?php

namespace App\Policies;

use App\Enums\PaymentStatus;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InvoicePolicy
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
        return $user->hasPermissionTo('show_all_invoices');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Invoice $invoice): bool
    {
        return $user->hasPermissionTo('show_invoice');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
         return $user->hasPermissionTo('create_invoice');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Invoice $invoice): bool
    {
          if ($invoice->payment_status === PaymentStatus::Paid) {
        return false;
    }
    
        return $user->hasPermissionTo('update_invoice');
    }
  
     /**
     * Determine whether the user hasPermissionTo change the status the model.
     */
       public function change_status(User $user, Invoice $model): bool
    {
         if ($model->payment_status === PaymentStatus::Paid) {
        return false;
    }
              return $user->hasPermissionTo('change_invoice_status');
    }


}
