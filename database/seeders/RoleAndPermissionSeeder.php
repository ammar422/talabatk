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
                'view menu',
                'place order',
                'view order status',
                'cancel order',
                'rate and review',
                'manage profile',
                'manage menu',
                'view orders',
                'update order status',
                'manage restaurant profile',
                'view ratings and reviews',
                'view assigned orders',
                'update delivery status',
                'view delivery history',
                'manage users',
                'manage roles and permissions',
                'view all orders',
                'manage system settings',
                'view reports and analytics',
                'resolve disputes'
            ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }

        Role::findByName('customer', 'api')->givePermissionTo([
            'view menu',
            'place order',
            'view order status',
            'cancel order',
            'rate and review',
            'manage profile'
        ]);

        Role::findByName('vendor', 'api')->givePermissionTo([
            'manage menu',
            'view orders',
            'update order status',
            'manage restaurant profile',
            'view ratings and reviews'
        ]);

        Role::findByName('delivery', 'api')->givePermissionTo([
            'view assigned orders',
            'update delivery status',
            'view delivery history',
            'manage profile'
        ]);

        Role::findByName('admin', 'api')->givePermissionTo(Permission::all());
    }
}
