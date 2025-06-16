<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryUmkm extends Model
{
    protected $table = 'category_umkm';

  

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
