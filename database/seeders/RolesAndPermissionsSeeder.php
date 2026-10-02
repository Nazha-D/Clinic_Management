<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
       

        $doctorPermissions=[ 
             'update_prescription',
            'show_all_prescriptions',
            'show_prescription',
            'create_prescription',
            'create_medical_record',
            'show_medical_record',
             'show_all_medical_records',
              'update_medical_record',
               
            'show_all_appointments',
            'show_appointment',
             'show_invoice',
            'change_appointment_status'   //change appointment status
            ];
            $accountantPermissions=[  
          
            'create_invoice',
            'show_invoice',
            'show_all_invoices',
            'update_invoice',  
             'change_invoice_status',
            'show_profit_reports'

            ];
            $receptionistPermissions=[
            'show_all_patients',
            'create_patient',
            'show_patient',
            'update_patient',
            'delete_patient',
            'show_all_users',
            'create_user',
            'show_user',
            'update_user',
            'delete_user',
            'show_all_doctors',
            'create_doctor',
            'update_doctor',
            'show_doctor',
            'delete_doctor',
          
            'show_all_appointments', 
            'book_appointment',
            'update_appointment',
           'delete_appointment',  
            'show_all_prescriptions',
            'show_prescription',
             'show_invoice',
            'show_medical_record',
             'show_all_medical_records',
            
            ];
        
        $allPermissions = array_unique(array_merge(
          
        $doctorPermissions,
        $accountantPermissions,
        $receptionistPermissions
        
        ));

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission,'guard_name'=>'api']);
        }
 $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'api']);
        $doctor     = Role::firstOrCreate(['name' => 'doctor', 'guard_name' => 'api']);
        $accountant = Role::firstOrCreate(['name' => 'accountant', 'guard_name' => 'api']);
        $receptionist = Role::firstOrCreate(['name' => 'receptionist', 'guard_name' => 'api']);

    
        $doctor->syncPermissions($doctorPermissions);
        $accountant->syncPermissions($accountantPermissions);
        $receptionist->syncPermissions($receptionistPermissions);

      
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
      
    }
}
