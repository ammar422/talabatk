<?php

namespace Database\Seeders;

use App\Models\DeliveryBoy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DeliveryBoySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryBoy::factory(10)->create([
            'password' => bcrypt('123456789')
        ]);

        $deliveryBoys =  DeliveryBoy::all();
        foreach ($deliveryBoys as $deliveryBoy) {
            $deliveryBoy->assignRole('delivery');
        }

        $permissions = [
            'view delivery boys',
            'create delivery boys',
            'edit delivery boys',
            'delete delivery boys'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }

        Role::findByName('delivery', 'api')->givePermissionTo('view delivery boys');
        Role::findByName('admin', 'api')->givePermissionTo($permissions);
    }
}
