<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $products = [];

        // Produk random untuk 15 UMKM pertama
        foreach (range(1, 15) as $umkmId) {
            foreach (range(1, 3) as $i) {
                $products[] = [
                    'umkm_id' => $umkmId,
                    'name' => ucfirst($faker->word) . ' ' . ucfirst($faker->colorName),
                    'description' => $faker->sentence,
                    'price' => $faker->randomFloat(2, 5000, 200000),
                    'stock' => $faker->numberBetween(1, 100),
                    'image' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // ========================
        // UMKM 99999 - Produk Sepatu
        // ========================
        $pathSepatu = '/home/rosan/Downloads/produk sepatu/';
        foreach (range(1, 10) as $i) {
            $imagePath = $pathSepatu . "produk{$i}.jpg";
            $imageName = 'sepatu_' . Str::random(10) . '.jpg';

            if (file_exists($imagePath)) {
                $storagePath = storage_path('app/public/products/' . $imageName);
                copy($imagePath, $storagePath);

                $products[] = [
                    'umkm_id' => 99999,
                    'name' => "Sepatu rosan {$i}",
                    'description' => "Deskripsi sepatu ke-{$i}",
                    'price' => $faker->randomFloat(2, 50000, 300000),
                    'stock' => $faker->numberBetween(5, 50),
                    'image' => 'products/' . $imageName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // ========================
        // UMKM 99998 - Produk Baju
        // ========================
        $pathBaju = '/home/rosan/Downloads/produk baju/';
        foreach (range(1, 10) as $i) {
            $imagePath = $pathBaju . "produk{$i}.jpg";
            $imageName = 'baju_' . Str::random(10) . '.jpg';

            if (file_exists($imagePath)) {
                $storagePath = storage_path('app/public/products/' . $imageName);
                copy($imagePath, $storagePath);

                $products[] = [
                    'umkm_id' => 99998,
                    'name' => "Baju Akbar {$i}",
                    'description' => "Deskripsi baju ke-{$i}",
                    'price' => $faker->randomFloat(2, 30000, 150000),
                    'stock' => $faker->numberBetween(5, 70),
                    'image' => 'products/' . $imageName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Simpan semua ke DB
        DB::table('products')->insert($products);
    }
}
