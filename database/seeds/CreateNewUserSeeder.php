<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\User as AppUser;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateNewUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the user
        $user = AppUser::create([
            'name' => 'NewUser',  // Replace with the new user's name
            'email' => 'newuser@example.com',  // Replace with the new user's email
            'password' => bcrypt('password123'),  // Replace with the new user's password
            'roles_name' => ["admin"],  // Replace with the desired role(s)
            'Status' => 'مفعل',  // Replace with the desired status
        ]);

        // Create a role
        $role = Role::create(['name' => 'owner']);  // Replace 'admin' with the new role name

        // Get all permissions
        $permissions = Permission::pluck('id','id')->all();

        // Sync permissions to the role
        $role->syncPermissions($permissions);

        // Assign the role to the user
        $user->assignRole([$role->id]);
    }
}
