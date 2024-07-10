<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // dummy data for User
        User::factory()->count(8)->create();

        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'johnD@gmail.com',
            'password' => Hash::make('secret'),
            'department' => 'IT Production',
            'position' => 'Mobile Developer',
            'role' => 'staff',
        ]);
        
        DB::table('users')->insert([
            'name' => 'Jane Doe',
            'email' => 'janedoe@gmail.com',
            'password' => Hash::make('secret'),
            'department' => 'HRD',
            'position' => 'Admin Personalia',
            'role' => 'admin',
        ]);

        // Dummy data for company
        Company::create([
            'name' => 'PT. Sabil',
            'email' => 'info@sabilsolution.id',
            'address' => 'Jl. Raya Ciputat Parung No. 1',
            'latitude' => '-6.3011',
            'longitude' => '106.7347',
            'radius_km' => '1',
            'time_in' => '08:00',
            'time_out' => '17:00',
        ]);

        // dummy data for attendances table
        $this->call([
            AttendanceSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}
