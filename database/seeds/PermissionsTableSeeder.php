<?php

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*
         * Add Permissions
         *
         */
        if (Permission::where('name', '=', 'Can View Users')->first() === null) {
            Permission::create([
                'name'        => 'Can View Users',
                'slug'        => 'view.users',
                'description' => 'Can view users',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Create Users')->first() === null) {
            Permission::create([
                'name'        => 'Can Create Users',
                'slug'        => 'create.users',
                'description' => 'Can create new users',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Edit Users')->first() === null) {
            Permission::create([
                'name'        => 'Can Edit Users',
                'slug'        => 'edit.users',
                'description' => 'Can edit users',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Delete Users')->first() === null) {
            Permission::create([
                'name'        => 'Can Delete Users',
                'slug'        => 'delete.users',
                'description' => 'Can delete users',
                'model'       => 'Permission',
            ]);
        }
		
		if (Permission::where('name', '=', 'Can View Company')->first() === null) {
            Permission::create([
                'name'        => 'Can View Company',
                'slug'        => 'view.company',
                'description' => 'Can view Company',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Create Company')->first() === null) {
            Permission::create([
                'name'        => 'Can Create Company',
                'slug'        => 'create.company',
                'description' => 'Can create new Company',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Edit Company')->first() === null) {
            Permission::create([
                'name'        => 'Can Edit Company',
                'slug'        => 'edit.company',
                'description' => 'Can edit Company',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Delete Company')->first() === null) {
            Permission::create([
                'name'        => 'Can Delete Company',
                'slug'        => 'delete.company',
                'description' => 'Can delete Company',
                'model'       => 'Permission',
            ]);
        }
		
		if (Permission::where('name', '=', 'Can View Employee')->first() === null) {
            Permission::create([
                'name'        => 'Can View Employee',
                'slug'        => 'view.employee',
                'description' => 'Can view Employee',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Create Employee')->first() === null) {
            Permission::create([
                'name'        => 'Can Create Employee',
                'slug'        => 'create.employee',
                'description' => 'Can create new Employee',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Edit Employee')->first() === null) {
            Permission::create([
                'name'        => 'Can Edit Employee',
                'slug'        => 'edit.employee',
                'description' => 'Can edit employee',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Delete Users')->first() === null) {
            Permission::create([
                'name'        => 'Can Delete Users',
                'slug'        => 'delete.users',
                'description' => 'Can delete users',
                'model'       => 'Permission',
            ]);
        }
    }
}
