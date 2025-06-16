<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $users = [];

        // Tambahkan 15 user fake dulu
        for ($i = 1; $i <= 15; $i++) {
            $users[] = [
                'id' => $i, 
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Tambahkan 2 user custom
        $users[] = [
            'id' => 99999,
            'name' => 'rosan',
            'email' => 'rosan@gmail.com',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $users[] = [
            'id' => 99998,
            'name' => 'Nazril Kanahaya Akbar',
            'email' => 'nazril@gmail.com',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert semua users sekaligus
        DB::table('users')->insert($users);
    }
}
