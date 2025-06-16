<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BundleSale extends Model
{
    use HasFactory;

    protected $fillable = ['bundle_id', 'quantity', 'total_price', 'sold_at'];

    protected $dates = ['sold_at'];

    protected $casts = [
        'sold_at' => 'date',
    ];
    

    public function bundle()
    {
        return $this->belongsTo(CollaborationProductBundle::class, 'bundle_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'bundle_sale_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    
}
