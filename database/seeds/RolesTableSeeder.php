<?php

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Add Roles
         *
         */
        if (Role::where('slug', '=', 'admin')->first() === null) {
            $adminRole = Role::create([
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 5,
            ]);
        }

        if (Role::where('slug', '=', 'company')->first() === null) {
            $userRole = Role::create([
                'name'        => 'Company',
                'slug'        => 'company',
                'description' => 'Company Role',
                'level'       => 4,
            ]);
        }
    }
}
