<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::factory(10)->create([
            'password' => bcrypt('123456789')
        ]);

        $vendors = Vendor::all();
        foreach ($vendors as $vendor)
            $vendor->assignRole('vendor');

        $permissions = [
            'view vendors',
            'create vendors',
            'update vendors',
            'delete vendors',
        ];
        foreach ($permissions as $permission)
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api'
            ]);

        Role::findByName('customer', 'api')->givePermissionTo('view vendors');
        Role::findByName('vendor', 'api')->givePermissionTo(['view vendors', 'view main categories', 'view sub categories']);
        Role::findByName('admin', 'api')->givePermissionTo($permissions);
    }
}
