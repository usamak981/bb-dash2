<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'users', 'guard_name' => 'web'],
            ['name' => 'users.*', 'guard_name' => 'web'],
            ['name' => 'users.view', 'guard_name' => 'web'],
            ['name' => 'users.index', 'guard_name' => 'web'],
            ['name' => 'users.create', 'guard_name' => 'web'],
            ['name' => 'users.store', 'guard_name' => 'web'],
            ['name' => 'users.edit', 'guard_name' => 'web'],
            ['name' => 'users.update', 'guard_name' => 'web'],
            ['name' => 'users.destroy', 'guard_name' => 'web'],
        ]);
    }
}
