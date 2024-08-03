<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offer::factory(10)->create();

        $permissions = [
            'create offers',
            'edit offers',
            'delete offers',
            'view offers',
        ];


        collect($permissions)->each(fn ($permission) => Permission::create(['name' => $permission, 'guard_name' => 'api']));

        Role::findByName('customer', 'api')->givePermissionTo('view offers');
        Role::findByName('vendor', 'api')->givePermissionTo($permissions);
        Role::findByName('admin', 'api')->givePermissionTo($permissions);
    }
}
