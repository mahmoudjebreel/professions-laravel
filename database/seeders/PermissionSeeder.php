<?php

namespace Database\Seeders;

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
        Permission::create(['name' => 'Create-Specialities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Edit-Specialities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Index-Specialities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Specialities', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Professions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Edit-Professions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Index-Professions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Professions', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Cities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Edit-Cities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Index-Cities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Cities', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Edit-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Index-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Roles', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Edit-Permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Index-Permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Permissions', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Edit-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Index-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Professional', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Edit-Professional', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Index-Professional', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Professional', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Customer', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Edit-Customer', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Index-Customer', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Customer', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Edit-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Index-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'admin']);
    }
}
