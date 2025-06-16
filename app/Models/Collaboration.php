<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    protected $guarded = ['id'];


    public function initiatorUmkm()
    {
        return $this->belongsTo(Umkm::class, 'initiator_umkm_id');
    }

    public function partnerUmkm()
    {
        return $this->belongsTo(Umkm::class, 'partner_umkm_id');
    }

    public function fromUmkm()
    {
        return $this->belongsTo(Umkm::class, 'initiator_umkm_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'collaboration_product');
    }

    public function productBundles()
    {
        return $this->hasMany(CollaborationProductBundle::class);
    }


}
