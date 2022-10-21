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
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@my-db.com',
            'password' => Hash::make('1234'),
            'role' => 'ADMIN',
            'created_at' => $now,
            'updated_at' => $now,
            'email_verified_at' => $now,
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@my-db.com',
            'password' => Hash::make('1234'),
            'role' => 'USER',
            'created_at' => $now,
            'updated_at' => $now,
            'email_verified_at' => $now,
        ]);

        
    }
}
