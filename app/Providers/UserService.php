<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

class UserService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

     public static function register_roles($roles_list) {
        if(Schema::hasTable('roles')) {
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            foreach ($roles_list as $role => $permissions)  {
                try {
                    $dbRole = Role::findByName($role);

                }catch(RoleDoesNotExist $e) {
                    $dbRole = Role::create(['name' => $role]);
                }

                foreach($permissions as $permission) {
                    try {

                    } catch(PermissionDoesNotExist $e) {
                        $dbPerm = Permission::create(['name' => $permission]);
                    }
                    $dbRole->givePermissionTo($permission);
                }
            }
        }
     }
    public function boot(): void
    {
        //
    }
}
