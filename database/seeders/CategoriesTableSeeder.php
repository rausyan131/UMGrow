<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $kategori = [
            'Makanan & Minuman',
            'Fashion & Aksesoris',
            'Jasa & Pelayanan',
            'Kerajinan Tangan',
            'Kosmetik & Kesehatan',
            'Produk Digital',
            'Elektronik',
            'Peralatan Rumah Tangga',
            'Pertanian & Perkebunan',
            'Otomotif',
            'Edukasi & Pelatihan',
            'Event & Hiburan',
            'Teknologi & Software',
            'Perdagangan & Grosir',
            'Transportasi & Logistik',
        ];

        foreach ($kategori as $nama) {
            DB::table('categories')->insert([
                'category_name' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
