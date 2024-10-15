<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ExportPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::insert([
            ['name' => 'exports', 'guard_name' => 'web'],
            ['name' => 'exports.*', 'guard_name' => 'web'],
            ['name' => 'exports.view', 'guard_name' => 'web'],
            ['name' => 'exports.index', 'guard_name' => 'web'],
            ['name' => 'exports.create', 'guard_name' => 'web'],
            ['name' => 'exports.store', 'guard_name' => 'web'],
            ['name' => 'exports.edit', 'guard_name' => 'web'],
            ['name' => 'exports.update', 'guard_name' => 'web'],
            ['name' => 'exports.destroy', 'guard_name' => 'web'],
        ]);
    }
}
