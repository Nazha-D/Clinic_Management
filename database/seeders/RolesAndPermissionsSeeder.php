<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
       

        $doctorPermissions=[  'update_prescription',
            'add_diagnosis', 'show_all_prescriptions',
            'show_prescription',
            'create_prescription','show_medical_record',
            'show_all_appointments',];
            $accountantPermissions=[    'update_fees',
            'create_invoice',
            'show_profit_reports'

            ];
            $receptionistPermissions=[
            'show_all_patients',
            'create_patient',
            'show_patient',
            'update_patient',
            'delete_patient',
            'show_all_doctors',
            'create_doctor',
            'update_doctor',
            'show_doctor',
            'delete_doctor',
            'show_medical_record',
            'show_all_appointments', 
            'book_appointment',
            'update_appointment',//change appointment status
            'show_all_prescriptions',
            'show_prescription',
            'create_prescription',
            ];
        
        $allPermissions = array_unique(array_merge(
          
        $doctorPermissions,
        $accountantPermissions,
        $receptionistPermissions
        
        ));

        foreach ($allPermissions as $permission) {
            Permission::create(['name' => $permission,'guard_name'=>'web']);
        }

       $superAdmin= Role::create(['name'=>'super_admin','guard_name' => 'web']);
      
        $doctor= Role::create(['name'=>'doctor','guard_name' => 'web']);
       foreach($doctorPermissions as $permission)
        {
            $doctor->givePermissionTo($permission);
        }
         $accountant= Role::create(['name'=>'accountant','guard_name' => 'web']);
   foreach($accountantPermissions as $permission)
    {
        $accountant->givePermissionTo($permission);
    }
         $receptionist= Role::create(['name'=>'receptionist','guard_name' => 'web']);
   foreach($receptionistPermissions as $permission)
    {
        $receptionist->givePermissionTo($permission);
    }
        
      
    }
}
