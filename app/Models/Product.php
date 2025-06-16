<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $guarded = ['id'];

    public function umkm(){

    return $this->belongsTo(Umkm::class);
    }

    public function collaborations()
    {
        return $this->belongsToMany(Collaboration::class, 'collaboration_product');
    }

    public function bundleSales()
    {
        return $this->belongsToMany(BundleSale::class, 'bundle_sale_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    

}
