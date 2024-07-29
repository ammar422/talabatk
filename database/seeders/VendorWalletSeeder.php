<?php

namespace Database\Seeders;

use App\Models\VendorWallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class VendorWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VendorWallet::factory(10)->create();

        $permissions = [
            'view vendor wallet',
            'update vendor wallet'
        ];

        collect($permissions)->each(fn ($permission) => Permission::create(['name' => $permission, 'guard_name' => 'api']));

        Role::findByName('admin', 'api')->givePermissionTo($permissions);
    }
}
