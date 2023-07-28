<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create default permissions
        //Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //create roles and permissions 
        $roleWithPermissions = [
            'manage-session' => [],
            'view-session' => [],
        ];

        foreach ($roleWithPermissions as $role=>$permissions) {
            try {
                $dbRole = Role::findByName($role);
            } catch (RoleDoesNotExist $e) {
                $dbRole = Role::create(['name' => $role]);
            }

            foreach ($permissions as $permission) {

                try{
                    $dbPerm = Permission::findByName($permission);
                } catch(PermissionDoesNotExist $e) {
                    $dbPerm = Permission::create(['name' => $permission]);
                }

                $dbRole->givePermissionTo($permission);
            }
        }
    }
}
