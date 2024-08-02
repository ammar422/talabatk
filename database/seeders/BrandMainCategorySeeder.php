<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\MainCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class BrandMainCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = Brand::all();
        $mainCategories = MainCategory::all();

        $brands->each(function ($brand) use ($mainCategories) {
            $brand->mainCategory()->attach(
                $mainCategories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // $permissions = [
        //     'create brands',
        //     'edit brands',
        //     'delete brands',
        //     'view brands'
        // ];

        // collect($permissions)->each(function ($permission) {
        //     Permission::create([
        //         'name' => $permission,
        //         'guard_name' => 'api'
        //     ]);
        // });

        // Role::findByName('customer', 'api')->givePermissionTo('view brands');
        // Role::findByName('admin', 'api')->givePermissionTo($permissions);
    }
}
