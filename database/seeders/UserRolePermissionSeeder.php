<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', User::USER)->first();
        $role->syncPermissions([
            'references','references.*','references.view','references.create','references.store','references.edit','references.update','references.destroy',
            'exports','exports.*','exports.view','exports.create','exports.store','exports.edit','exports.update','exports.destroy',
            'pictures', 'pictures.*', 'pictures.view', 'pictures.show', 'pictures.update', 'pictures.destroy',
            'profile', 'profile.*', 'profile.update'
        ]);
    }
}
