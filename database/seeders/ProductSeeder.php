<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(10)->create();


        $permissions = [
            'view products',
            'create products',
            'update products',
            'delete products',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }

        Role::findByName('customer', 'api')->givePermissionTo('view products');
        Role::findByName('vendor', 'api')->givePermissionTo(['view products', 'update products', 'delete products',]);
        Role::findByName('admin', 'api')->givePermissionTo($permissions);
        
    }
}
