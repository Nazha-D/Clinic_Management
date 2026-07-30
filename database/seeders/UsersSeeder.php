<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminUser=User::create(['name'=>'SUPER ADMIN','email'=>'super_admin@email.com','password'=>Hash::make('123456')]);
        $doctorUser=User::create(['name'=>'Test Doctor','email'=>'test_doctor@email.com','password'=>Hash::make('123456')]);
        $receptionistUser=User::create(['name'=>'Test Receptionist','email'=>'test_receptionist@email.com','password'=>Hash::make('123456')]);
        $accountantUser=User::create(['name'=>'Test Accountant','email'=>'test_accountant@email.com','password'=>Hash::make('123456')]);
        $superAdminUser->assignRole('super_admin');
        $doctorUser->assignRole('doctor');
        $receptionistUser->assignRole('receptionist');
        $accountantUser->assignRole('accountant');
    }
}
