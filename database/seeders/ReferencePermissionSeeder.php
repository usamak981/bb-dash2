<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ReferencePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'references', 'guard_name' => 'web'],
            ['name' => 'references.*', 'guard_name' => 'web'],
            ['name' => 'references.view', 'guard_name' => 'web'],
            ['name' => 'references.index', 'guard_name' => 'web'],
            ['name' => 'references.create', 'guard_name' => 'web'],
            ['name' => 'references.store', 'guard_name' => 'web'],
            ['name' => 'references.edit', 'guard_name' => 'web'],
            ['name' => 'references.update', 'guard_name' => 'web'],
            ['name' => 'references.destroy', 'guard_name' => 'web'],
        ]);
    }
}
