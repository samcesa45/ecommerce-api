<?php

namespace Database\Seeders;

use Carbon\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Providers\UserService;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /**
     * Create the initial roles and permissions.
     * @return void
     */
    public function run(): void
    {
        
        //Seed Roles in this application with their permissions.
        UserService::register_roles(AppServiceProvider::array_of_roles());
        Schema::defaultStringLength(125);

        //array of users seed
        $users = [
           [
            'email' => 'admin@app.com',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'telephone' => '08023145678',
            'date_of_birth' => Carbon::now()->format('Y-m-d'),
            'username'=> 'admin1',
            'password' => bcrypt('password'),
            'roles' => 'admin',
           ],
           [
            'email' => 'customer1@app.com',
            'first_name' => 'Customer',
            'last_name' => 'Customer',
            'telephone' => '07023145678',
            'date_of_birth' => Carbon::now()->format('Y-m-d'),
            'username'=> 'customer1',
            'password' => bcrypt('password'),
            'roles' => 'customer',
           ],
        ];

        foreach($users as $key => $value) {
            if(empty(User::where('email',$value['email'])->first())) {
                $user_roles = explode(',', $value['roles'] ?? '');
                array_pop($value);
                $user_data = User::create($value);
                $user_data->syncRoles($user_roles);
            }
        }

    }
}
