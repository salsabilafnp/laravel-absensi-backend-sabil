<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // dummy data for attendances table
        Attendance::factory()->count(5)->create(
            [
                'user_id' => 9,
            ]
        );

        DB::table('attendances')->insert(
            [
                'user_id' => 9,
                'date' => '2024-07-08',
                'checkIn_time' => '08:10',
                'checkOut_time' => '17:05',
                'latlon_in' => '-6.3011,106.7347',
                'latlon_out' => '-6.3011,106.7347',
            ]
        );

        Attendance::factory()->count(5)->create(
            [
                'user_id' => 10,
            ]
        );

        DB::table('attendances')->insert(
            [
                'user_id' => 10,
                'date' => '2024-07-09',
                'checkIn_time' => '08:00',
                'checkOut_time' => '17:15',
                'latlon_in' => '-6.3011,106.7347',
                'latlon_out' => '-6.3011,106.7347',
            ]
        );
    }
}
