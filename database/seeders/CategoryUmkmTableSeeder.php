<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryUmkmTableSeeder extends Seeder
{
    public function run()
    {
        $umkmIds = DB::table('umkm')->pluck('id')->toArray(); // Ambil semua ID umkm valid
        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        foreach ($umkmIds as $umkmId) {
            $jumlahKategori = rand(1, 3);
            $kategoriAcak = collect($categoryIds)->shuffle()->take($jumlahKategori);

            foreach ($kategoriAcak as $categoryId) {
                DB::table('category_umkm')->insert([
                    'umkm_id' => $umkmId,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
