<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::factory(10)->create();

        $permissions = [
            'view sub categories',
            'create sub categories',
            'update sub categories',
            'delete sub categories',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }

        Role::findByName('customer', 'api')->givePermissionTo('view sub categories');
        Role::findByName('admin', 'api')->givePermissionTo($permissions);
    }
}
