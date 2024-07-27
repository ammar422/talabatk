<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Order::factory(10)->create();

        Permission::create(['name' => 'checkout' , 'guard_name' => 'api']);
        
        Role::findByName('customer' , 'api')->givePermissionTo('checkout');
    }
}
