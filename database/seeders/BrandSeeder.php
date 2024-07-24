<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory(10)->create();


        $permissions = [
            'view brands',
            'create brands',
            'update brands',
            'delete brands',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }
        Role::findByName('customer', 'api')->givePermissionTo('view brands');
        Role::findByName('admin', 'api')->givePermissionTo($permissions);
    }
}
