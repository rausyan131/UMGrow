<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $guarded = ['id'];
    protected $table = 'umkm';

    protected $casts = [
        'certificates' => 'array',
        'gallery' => 'array',

    ];

    

    public function user(){
    return $this->belongsTo(User::class);
    }

    public function categories() {
    return $this->belongsToMany(Category::class, 'category_umkm');
    }


    public function products(){
    return $this->hasMany(Product::class);
    }




}
