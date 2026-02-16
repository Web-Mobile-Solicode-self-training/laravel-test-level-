<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'access-admin']);
        Permission::create(['name' => 'create-goal']);
        Permission::create(['name' => 'edit-goal']);
        Permission::create(['name' => 'delete-goal']);

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(['access-admin', 'edit-goal', 'delete-goal']);

        $authorRole = Role::create(['name' => 'author']);
        $authorRole->givePermissionTo(['access-admin', 'create-goal', 'edit-goal', 'delete-goal']);
    }
}
