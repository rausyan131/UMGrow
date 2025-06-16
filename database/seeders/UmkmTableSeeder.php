<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UmkmTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $umkms = [];

        // 15 UMKM palsu
        for ($i = 1; $i <= 15; $i++) {
            $umkms[] = [
                'id' => $i,
                'user_id' => $i,
                'umkm_name' => 'UMKM ' . $faker->company,
                'description' => $faker->paragraph,
                'location' => $faker->address,
                'phone' => $faker->phoneNumber,
                'website_url' => $faker->url,
                'instagram_url' => 'https://instagram.com/' . $faker->userName,
                'facebook_url' => 'https://facebook.com/' . $faker->userName,
                'image' => null,
                'gallery' => json_encode([]),
                'certificates' => json_encode([]),
                'is_profile_complete' => $faker->boolean(80),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // 2 UMKM manual
        $umkms[] = [
            'id' => 99999,
            'user_id' => 99999,
            'umkm_name' => 'UMKM Sepatu',
            'description' => 'Sepatu handmade dari bahan kulit asli.',
            'location' => 'Jl. Sepatu Keren No. 99',
            'phone' => '082233445566',
            'website_url' => 'https://umkmsepatu.com',
            'instagram_url' => 'https://instagram.com/umkmsepatu',
            'facebook_url' => 'https://facebook.com/umkmsepatu',
            'image' => null,
            'gallery' => json_encode([]),
            'certificates' => json_encode([]),
            'is_profile_complete' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $umkms[] = [
            'id' => 99998,
            'user_id' => 99998,
            'umkm_name' => 'UMKM Baju',
            'description' => 'Menjual baju berkualitas tinggi dengan harga terjangkau.',
            'location' => 'Jl. Baju Bagus No. 98',
            'phone' => '081234567890',
            'website_url' => 'https://umkmbaju.com',
            'instagram_url' => 'https://instagram.com/umkmbaju',
            'facebook_url' => 'https://facebook.com/umkmbaju',
            'image' => null,
            'gallery' => json_encode([]),
            'certificates' => json_encode([]),
            'is_profile_complete' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert semuanya sekali aja
        DB::table('umkm')->insert($umkms);
    }
}
