<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ProfilePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'profile', 'guard_name' => 'web'],
            ['name' => 'profile.*', 'guard_name' => 'web'],
            ['name' => 'profile.update', 'guard_name' => 'web'],
        ]);
    }
}
