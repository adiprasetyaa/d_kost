<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            // Administrator [1]
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'password' => Hash::make('123123123'),
                'role' => 'admin',
            ],

            [
                'name' => 'User 1',
                'email' => 'user1@gmail.com',
                'username' => 'user1',
                'password' => Hash::make('123123123'),
                'role' => 'user',
            ],

            [
                'name' => 'User 2',
                'email' => 'user2@gmail.com',
                'username' => 'user2',
                'password' => Hash::make('123123123'),
                'role' => 'user',
            ],

            [
                'name' => 'User 3',
                'email' => 'user3@gmail.com',
                'username' => 'user3',
                'password' => Hash::make('123123123'),
                'role' => 'user',
            ],

            [
                'name' => 'User 4',
                'email' => 'user4@gmail.com',
                'username' => 'user4',
                'password' => Hash::make('123123123'),
                'role' => 'user',
            ],

            [
                'name' => 'User 5',
                'email' => 'user5@gmail.com',
                'username' => 'user5',
                'password' => Hash::make('123123123'),
                'role' => 'user',
            ],
            
            
        ]);
    }
}
