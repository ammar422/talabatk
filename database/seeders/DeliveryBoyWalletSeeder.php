<?php

namespace Database\Seeders;

use App\Models\DeliveryBoyWallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DeliveryBoyWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryBoyWallet::factory(10)->create();

        $permissions = [
            'view delivery wallet',
            'update delivery wallet',
        ];

        collect($permissions)->each(fn ($permission) => Permission::create(['name' => $permission, 'guard_name' => 'api']));


        Role::findByName('admin','api')->givePermissionTo($permissions);
    }
}
