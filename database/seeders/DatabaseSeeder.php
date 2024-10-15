<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,

            AdminUpdatePermissionSeeder::class,
            ExportPermissionSeeder::class,
            ImagesPermissionSeeder::class,
            ReferencePermissionSeeder::class,
            ProfilePermissionSeeder::class,
            UserPermissionSeeder::class,

            SuperAdminRolePermissionSeeder::class,
            AdminRolePermissionSeeder::class,
            UserRolePermissionSeeder::class,

            ProjektTypeSeeder::class,
            CountrySeeder::class
        ]);
    }
}
