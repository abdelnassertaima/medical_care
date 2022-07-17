<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //****************** ADMIN ******************//
        Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Doctor', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Doctors', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Doctor', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Doctor', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Patient', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Patients', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Patient', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Patient', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Clinic', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Clinics', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Clinic', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Clinic', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Booking', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Bookings', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Booking', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Booking', 'guard_name' => 'admin']);
        
        Permission::create(['name' => 'Create-Employee', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Employees', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Employee', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Employee', 'guard_name' => 'admin']);

        //****************** Doctor ******************//
        Permission::create(['name' => 'Create-Role', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'doctor']);

        Permission::create(['name' => 'Create-Permission', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Update-Permission', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'doctor']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'doctor']);

        Permission::create(['name' => 'Create-Doctor', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Read-Doctors', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Update-Doctor', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Delete-Doctor', 'guard_name' => 'doctor']);

        Permission::create(['name' => 'Create-Patient', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Read-Patients', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Update-Patient', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Delete-Patient', 'guard_name' => 'doctor']);

        Permission::create(['name' => 'Create-Clinic', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Read-Clinics', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Update-Clinic', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Delete-Clinic', 'guard_name' => 'doctor']);

        Permission::create(['name' => 'Create-Booking', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Read-Bookings', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Update-Booking', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Delete-Booking', 'guard_name' => 'doctor']);
        
        Permission::create(['name' => 'Create-Employee', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Read-Employees', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Update-Employee', 'guard_name' => 'doctor']);
        Permission::create(['name' => 'Delete-Employee', 'guard_name' => 'doctor']);

        //****************** Patient ******************//
        Permission::create(['name' => 'Create-Role', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'employee']);

        Permission::create(['name' => 'Create-Permission', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Update-Permission', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'employee']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'employee']);

        Permission::create(['name' => 'Create-Doctor', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Read-Doctors', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Update-Doctor', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Delete-Doctor', 'guard_name' => 'employee']);

        Permission::create(['name' => 'Create-Employee', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Read-Employees', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Update-Employee', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Delete-Employee', 'guard_name' => 'employee']);

        Permission::create(['name' => 'Create-Patient', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Read-Patients', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Update-Patient', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Delete-Patient', 'guard_name' => 'employee']);

        Permission::create(['name' => 'Create-Clinic', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Read-Clinics', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Update-Clinic', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Delete-Clinic', 'guard_name' => 'employee']);

        Permission::create(['name' => 'Create-Booking', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Read-Bookings', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Update-Booking', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Delete-Booking', 'guard_name' => 'employee']);

        //****************** Patient ******************//
        Permission::create(['name' => 'Create-Role', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'patient']);

        Permission::create(['name' => 'Create-Permission', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Update-Permission', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'patient']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'patient']);

        Permission::create(['name' => 'Create-Doctor', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Read-Doctors', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Update-Doctor', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Delete-Doctor', 'guard_name' => 'patient']);

        Permission::create(['name' => 'Create-Patient', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Read-Patients', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Update-Patient', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Delete-Patient', 'guard_name' => 'patient']);

        Permission::create(['name' => 'Create-Clinic', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Read-Clinics', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Update-Clinic', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Delete-Clinic', 'guard_name' => 'patient']);

        Permission::create(['name' => 'Create-Booking', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Read-Bookings', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Update-Booking', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Delete-Booking', 'guard_name' => 'patient']);
        
        Permission::create(['name' => 'Create-Employee', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Read-Employees', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Update-Employee', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Delete-Employee', 'guard_name' => 'patient']);
    }
}
