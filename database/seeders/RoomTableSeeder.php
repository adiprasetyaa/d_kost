<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('room')->insert([

            // Room 1
            [
                'room_number' => '1',
                'room_type' => 'Small',
                'room_floor' => '1',
                'rental_price' => 1000,
            ],

            [
                'room_number' => '2',
                'room_type' => 'Small',
                'room_floor' => '1',
                'rental_price' => 1000,
            ],

            [
                'room_number' => '3',
                'room_type' => 'Small',
                'room_floor' => '1',
                'rental_price' => 1000,
            ],

            [
                'room_number' => '4',
                'room_type' => 'Small',
                'room_floor' => '1',
                'rental_price' => 1000,
            ],

            [
                'room_number' => '5',
                'room_type' => 'Small',
                'room_floor' => '1',
                'rental_price' => 1000,
            ],
            
        ]);
    }
}
