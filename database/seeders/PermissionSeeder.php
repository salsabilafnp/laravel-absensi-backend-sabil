<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // generate 5 permissions for 9
        Permission::factory()->count(5)->create(
            [
                'user_id' => 9,
            ]
        );

        // generate 5 permissions for 10
        Permission::factory()->count(5)->create(
            [
                'user_id' => 10,
            ]
        );
    }
}
