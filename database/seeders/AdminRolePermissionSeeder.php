<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', User::ADMIN)->first();
        $role->syncPermissions([
            'users','users.view','users.*','users.create','users.store','users.edit','users.update','users.destroy',
            'references','references.*','references.view','references.create','references.store','references.edit','references.update','references.destroy',
            'exports','exports.*','exports.view','exports.create','exports.store','exports.edit','exports.update','exports.destroy',
            'pictures', 'pictures.*', 'pictures.view', 'pictures.show', 'pictures.update', 'pictures.destroy',
            'profile', 'profile.*', 'profile.update']);
    }
}
