<?php

namespace Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate(); // Using truncate function so all info will be cleared when re-seeding.
        DB::table('roles')->truncate();
        DB::table('role_users')->truncate();
        DB::table('activations')->truncate();

        // create 2 users
        $admin = Sentinel::registerAndActivate(array(
            'email' => 'admin@admin.com',
            'password' => "123456",
            'first_name' => 'John',
            'last_name' => 'Doe'
        ));
        $user = Sentinel::registerAndActivate(array(
            'email' => 'user@admin.com',
            'password' => "123456",
            'first_name' => 'John',
            'last_name' => 'Doe'
        ));

        $adminRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Admin',
            'slug' => 'root',
            'permissions' => [],
        ]);

        $user->roles()->attach($adminRole);
        $admin->roles()->attach($adminRole);

        $this->command->info('Admin User created with username admin@admin.com and password 123456');

    }
}
