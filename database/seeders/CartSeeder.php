<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cart::factory(10)->create();


        $permissions = [
            'view cart',
            'create cart',
            'update cart',
            'delete cart'
        ];
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }

        Role::findByName('customer' , 'api') ->givePermissionTo($permissions);
        Role::findByName('admin' , 'api') ->givePermissionTo($permissions);
    }
}
