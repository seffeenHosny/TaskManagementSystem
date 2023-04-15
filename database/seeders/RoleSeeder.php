<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create employee
        $employee = Role::create(['name' => 'employee']);
        $employee_permissions = [2 , 6 , 7];
        $employee->givePermissionTo($employee_permissions);

        // create manager
        $manager = Role::create(['name' => 'manager']);
        $manager_permissions = range(1, 11);
        $manager->givePermissionTo($manager_permissions);

    }
}
