<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory(10)->create([
            'password' => bcrypt('123456789'),
        ]);

        foreach (Admin::all() as $admin) {
            $admin->assignRole('admin');
        }
    }
}
