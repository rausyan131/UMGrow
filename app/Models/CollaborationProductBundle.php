<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaborationProductBundle extends Model
{
    protected $guarded =['id'];

    public function collaboration()
    {
        return $this->belongsTo(Collaboration::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'bundle_items', 'bundle_id', 'product_id');
    }

    public function bundleSales()
    {
        return $this->belongsToMany(BundleSale::class, 'bundle_sale_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    
    
    


}
