<?php

namespace Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // create 2 roles
        $adminRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Bố',
            'slug' => 'bo',
            'permissions' => [],
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Mẹ',
            'slug' => 'me',
            'permissions' => [],
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Con',
            'slug' => 'con',
            'permissions' => [],
        ]);

    }
}
