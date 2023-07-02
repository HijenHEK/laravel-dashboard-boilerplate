<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $no_permission = Permission::create(['name' => 'no permission']);

        // create user management permissions
        $permission_user_1 = Permission::create(['name' => 'create user']);
        $permission_user_2 = Permission::create(['name' => 'read user']);
        $permission_user_3 = Permission::create(['name' => 'update user']);
        $permission_user_4 = Permission::create(['name' => 'delete user']);

        // create role management permissions
        $permission_role_1 = Permission::create(['name' => 'create role']);
        $permission_role_2 = Permission::create(['name' => 'read role']);
        $permission_role_3 = Permission::create(['name' => 'update role']);
        $permission_role_4 = Permission::create(['name' => 'delete role']);

        // create permission management permissions
        $permission_permission_1 = Permission::create(['name' => 'create permission']);
        $permission_permission_2 = Permission::create(['name' => 'read permission']);
        $permission_permission_3 = Permission::create(['name' => 'update permission']);
        $permission_permission_4 = Permission::create(['name' => 'delete permission']);

        // create admin management permissions
        $permission_admin_1 = Permission::create(['name' => 'read admin']);
        $permission_admin_2 = Permission::create(['name' => 'update admin']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $user_role = Role::create(['name' => 'user'])->syncPermissions([
            $no_permission
        ]);

        $admin_role = Role::create(['name' => 'admin'])->syncPermissions([
            $permission_user_1,
            $permission_user_2,
            $permission_user_3,
            $permission_role_1,
            $permission_role_2,
            $permission_admin_1
        ]);

        $super_admin_role = Role::create(['name' => 'super-admin'])->syncPermissions(Permission::all());

        User::first()->assignRole($super_admin_role);
    }
}
