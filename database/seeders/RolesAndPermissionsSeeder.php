<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::firstOrCreate(['name' => 'view own attendance']);
        Permission::firstOrCreate(['name' => 'create attendance']);
        Permission::firstOrCreate(['name' => 'view class attendance']);
        Permission::firstOrCreate(['name' => 'manage own class attendance']);
        Permission::firstOrCreate(['name' => 'view all reports']);
        Permission::firstOrCreate(['name' => 'manage all users']);
        Permission::firstOrCreate(['name' => 'manage classes']);
        Permission::firstOrCreate(['name' => 'manage students']);
        Permission::firstOrCreate(['name' => 'view students']);
        Permission::firstOrCreate(['name' => 'manage teachers']);

        $studentRole = Role::firstOrCreate(['name' => 'student']);
        $studentRole->syncPermissions(['view own attendance', 'create attendance']);

        $teacherRole = Role::firstOrCreate(['name' => 'teacher']);
        $teacherRole->syncPermissions(['view own attendance', 'view class attendance', 'manage own class attendance']);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        $adminUser = User::find(1);
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }
    }
}