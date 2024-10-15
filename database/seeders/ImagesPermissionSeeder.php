<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ImagesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'pictures', 'guard_name' => 'web'],
            ['name' => 'pictures.*', 'guard_name' => 'web'],
            ['name' => 'pictures.view', 'guard_name' => 'web'],
            ['name' => 'pictures.show', 'guard_name' => 'web'],
            ['name' => 'pictures.update', 'guard_name' => 'web'],
            ['name' => 'pictures.destroy', 'guard_name' => 'web'],
        ]);
    }
}
