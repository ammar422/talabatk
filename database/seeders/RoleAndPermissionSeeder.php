<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles =
            [
                'customer',
                'vendor',
                'delivery',
                'admin'
            ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'guard_name' => 'api'
            ]);
        }

        $permissions =
            [
                // Define permissions for main categories
                'view main categories',
                'create main categories',
                'update main categories',
                'delete main categories',
            ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }

        Role::findByName('customer', 'api')->givePermissionTo([
            'view main categories',
        ]);

        // Role::findByName('vendor', 'api')->givePermissionTo([

        // ]);

        // Role::findByName('delivery', 'api')->givePermissionTo([
        
        // ]);

        Role::findByName('admin', 'api')->givePermissionTo(Permission::all());
    }
}
