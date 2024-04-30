<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Sabil',
            'email' => 'sabil@gmail.com',
            'password' => Hash::make('secret'),
        ]);

        // Dummy data for company
        \App\Models\Company::create([
            'name' => 'PT. Sabil',
            'email' => 'info@sabilsolution.id',
            'address' => 'Jl. Raya Ciputat Parung No. 1',
            'latitude' => '-6.3011',
            'longitude' => '106.7347',
            'radius_km' => '1',
            'time_in' => '08:00',
            'time_out' => '17:00',
        ]);
    }
}
