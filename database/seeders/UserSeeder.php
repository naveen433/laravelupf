<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

          // Or manual regular users
        DB::table('users')->insert([
            [
                'name' => 'Test User 1',
                'username' => 'developer',
                'email' => 'devloper@example.com',
                'password' => Hash::make('Test@Password123#'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
          
        ]);
    }
}
