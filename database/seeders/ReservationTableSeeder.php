<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservation')->insert([

            [
                'reservation_date' => '2023-07-01',
                'reservation_status' => 'accepted',
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 1,
                'room_id' => 1,
            ],
            [
                'reservation_date' => '2023-07-02',
                'reservation_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 2,
                'room_id' => 2,
            ],
            [
                'reservation_date' => '2023-07-03',
                'reservation_status' => 'rejected',
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 3,
                'room_id' => 3,
            ],
        ]);
    }   
}
